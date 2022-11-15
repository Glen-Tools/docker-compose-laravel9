<?php

namespace App\Dto;

class InputLoginDto
{
    public readonly string $account;
    public readonly string $password;
    public readonly ?string $captcha;
    public readonly ?string $captchaId;


    public function __construct(string $account, string $password, string $captcha = "", string $captchaId = "")
    {
        $this->account = $account;
        $this->password = $password;
        $this->captcha = $captcha;
        $this->captchaId = $captchaId;
    }
}
