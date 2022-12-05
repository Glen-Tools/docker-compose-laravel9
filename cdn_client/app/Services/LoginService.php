<?php

namespace App\Services;

use App\Dto\InputLoginDto;
use App\Dto\OutputAuthUserInfoDto;
use App\Exceptions\ParameterException;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class LoginService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(InputLoginDto $inputLoginDto): OutputAuthUserInfoDto
    {
        $outputUserInfoDto = $this->getUserInfoByLogin($inputLoginDto->account);
        $isLogin = $this->userRepository->validPassword($outputUserInfoDto->id, $inputLoginDto->password);
        if (!$isLogin) {
            throw new ParameterException(trans('error.password'), Response::HTTP_BAD_REQUEST);
        }
        return $outputUserInfoDto;
    }

    public function setLoginInfo(int $userId, string $ip): void
    {
        $this->userRepository->updateUserLoginInfo($ip, $userId);
        return;
    }

    public function getUserInfoByLogin(string $account): OutputAuthUserInfoDto
    {
        $user = $this->userRepository->getUserByAccount($account);
        if (empty($user)) {
            throw new ParameterException(trans('error.user_not_found'), Response::HTTP_BAD_REQUEST);
        }

        $outputUserInfoDto = new OutputAuthUserInfoDto(
            $user->id,
            $user->name,
            $user->email,
            $user->user_type,
        );

        return   $outputUserInfoDto;
    }
}
