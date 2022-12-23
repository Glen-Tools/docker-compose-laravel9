<?php

namespace App\Services;

use App\Dto\InputUserRoleDto;
use App\Dto\InputLoginDto;
use App\Dto\OutputAuthUserInfoDto;
use App\Dto\InputEmailValidationDto;

use App\Mail\ValidationEmail;
use App\Exceptions\ParameterException;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class LoginService
{
    protected $userRepository;
    private $cacheService;

    public const CACHE_REGISTER_IN_CODE = "CACHE_REGISTER_IN_CODE";
    public const CACHE_PASSWORD_FORGOT_CODE = "CACHE_PASSWORD_FORGOT_CODE";
    protected const CACHE_TIME = 1200;

    public function __construct(
        UserRepository $userRepository,
        CacheService $cacheService
    ) {
        $this->userRepository = $userRepository;
        $this->cacheService = $cacheService;
    }

    public function login(InputLoginDto $inputLoginDto): OutputAuthUserInfoDto
    {
        $outputAuthUserInfoDto = $this->getUserInfoByLogin($inputLoginDto->account);
        $isLogin = $this->userRepository->validPassword($outputAuthUserInfoDto->id, $inputLoginDto->password);
        if (!$isLogin) {
            throw new ParameterException(trans('error.password'), Response::HTTP_BAD_REQUEST);
        }
        return $outputAuthUserInfoDto;
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

        $outputAuthUserInfoDto = new OutputAuthUserInfoDto(
            $user->id,
            $user->name,
            $user->email,
            $user->user_type,
        );

        return   $outputAuthUserInfoDto;
    }

    public function exsitUser(string $account): bool
    {
        $user = $this->userRepository->getUserByAccount($account);
        if (empty($user)) {
            return false;
        }
        return true;
    }

    public function getRegInCodeCacheNameByAccount(string $account)
    {
        return $this::CACHE_REGISTER_IN_CODE . "_$account";
    }

    public function getPwdForgotCodeCacheNameByAccount(string $account)
    {
        return $this::CACHE_PASSWORD_FORGOT_CODE . "_$account";
    }

    public function regInValidCode(string $account)
    {
        $checkUser = $this->exsitUser($account);
        $cacheName = $this->getRegInCodeCacheNameByAccount($account);
        $checkAccount =  $this->cacheService->getByJson($cacheName);
        if ($checkUser || isset($checkAccount)) {
            throw new ParameterException(trans('error.user_has_exsit'), Response::HTTP_BAD_REQUEST);
        }

        $ValidationCode = Str::random(8);
        $this->cacheService->putByJson($cacheName, $ValidationCode, $this::CACHE_TIME);

        $mailContent = trans('email.register_in.page_content', ["code" => $ValidationCode]) .
            "\r\n" . trans('email.validation_code', ["expireTime" => $this::CACHE_TIME / 60]);

        $mailData = new InputEmailValidationDto(
            trans('email.validation_view'),
            trans('email.register_in.subject', ["app_name" => env("MAIL_WEB_NAME")]),
            trans('email.register_in.title', ["app_name" => env("MAIL_WEB_NAME"), "account" => $account]),
            $mailContent
        );

        //send email
        Mail::to($account)->send(new ValidationEmail((array)$mailData));
    }

    public function pwdForgotValidCodeAndEmail(string $account)
    {
        $checkUser = $this->exsitUser($account);
        if (!$checkUser) {
            throw new ParameterException(trans('error.user_not_found'), Response::HTTP_BAD_REQUEST);
        }

        $ValidationCode = Str::random(8);
        $cacheName = $this->getPwdForgotCodeCacheNameByAccount($account);
        $this->cacheService->putByJson($cacheName, $ValidationCode, $this::CACHE_TIME);

        $mailContent = trans('email.fogot_password.page_content', ["code" => $ValidationCode]) .
            "\r\n" . trans('email.validation_code', ["expireTime" => $this::CACHE_TIME / 60]);

        $mailData = new InputEmailValidationDto(
            trans('email.validation_view'),
            trans('email.fogot_password.subject', ["app_name" => env("MAIL_WEB_NAME")]),
            trans('email.fogot_password.title', ["app_name" => env("MAIL_WEB_NAME"), "account" => $account]),
            $mailContent
        );

        //send email
        Mail::to($account)->send(new ValidationEmail((array)$mailData));
    }

    public function validCacheValueByCacheName(string $cacheName, string $ValidationCode, string $errLang)
    {
        $cacheValidation =  $this->cacheService->getByJson($cacheName);
        if ($cacheValidation != $ValidationCode) {
            throw new ParameterException($errLang, Response::HTTP_BAD_REQUEST);
        }
    }
}
