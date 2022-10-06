<?php

namespace App\Dto;

class InputPayloadDto
{
    protected $iss;
    protected $exp;
    protected $nbf;
    protected $iat;
    protected $tokenType;
    protected $userInfo;


    public function __construct(string $iss, int $exp, int $nbf, int $iat, string $tokenType, OutputUserInfoDto $userInfo)
    {
        $this->iss = $iss;
        $this->exp = $exp;
        $this->nbf = $nbf;
        $this->iat = $iat;
        $this->tokenType = $tokenType;
        $this->userInfo = $userInfo;
    }

    /**
     * Set the value of iss
     *
     * @return  self
     */
    public function setIss($iss)
    {
        $this->iss = $iss;

        return $this;
    }

    /**
     * Set the value of exp
     *
     * @return  self
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Set the value of nbf
     *
     * @return  self
     */
    public function setNbf($nbf)
    {
        $this->nbf = $nbf;

        return $this;
    }

    /**
     * Set the value of iat
     *
     * @return  self
     */
    public function setIat($iat)
    {
        $this->iat = $iat;

        return $this;
    }

    /**
     * Set the value of tokenType
     *
     * @return  self
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Set the value of userInfo
     *
     * @return  self
     */
    public function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;

        return $this;
    }

    /**
     * Get the value of iss
     */
    public function getIss()
    {
        return $this->iss;
    }

    /**
     * Get the value of exp
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Get the value of nbf
     */
    public function getNbf()
    {
        return $this->nbf;
    }

    /**
     * Get the value of iat
     */
    public function getIat()
    {
        return $this->iat;
    }

    /**
     * Get the value of tokenType
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Get the value of userInfo
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }
}
