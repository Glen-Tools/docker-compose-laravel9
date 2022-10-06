<?php

namespace App\Services;

use App\Dto\InputLoginDto;
use App\Dto\OutputUserInfoDto;
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

    public function login(InputLoginDto $inputLoginDto)
    {
        $user = $this->userRepository->getUserByAccount($inputLoginDto->getAccount());
        if (empty($user)) {
            throw new ParameterException(trans('error.user_not_found'));
        }

        $isLogin = $this->userRepository->validPassword($user->id, $inputLoginDto->getPassword());
        if (!$isLogin) {
            throw new ParameterException(trans('error.password'), Response::HTTP_BAD_REQUEST);
        }

        $outputUserInfoDto = new OutputUserInfoDto(
            $user->id,
            $user->name,
            $user->email,
            $user->user_type,
        );

        return $outputUserInfoDto;
    }
}
