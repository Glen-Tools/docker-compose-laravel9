<?php

namespace App\Dto;

class InputLoginDto
{
    protected ?string $account;
    protected ?string $password;
    protected ?string $captcha;
    protected ?string $captchaId;


    public function __construct(string $account,string $password,string $captcha = "",string $captchaId = "")
    {
        $this->account = $account;
        $this->password = $password;
        $this->captcha = $captcha;
        $this->captchaId = $captchaId;
    }

    /**
     * Set the value of account
     *
     * @return  self
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of captcha
     *
     * @return  self
     */
    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;

        return $this;
    }

    /**
     * Get the value of account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of captcha
     */
    public function getCaptcha()
    {
        return $this->captcha;
    }
}
