<?php

namespace App\Dto;

class InputUserDto
{
    protected ?string $name;
    protected ?string $email;
    protected ?string $password;
    protected ?bool $status;
    protected ?int $userType;
    protected ?string $remark;

    public function __construct(string $name,string $email,string $password,bool $status,int $userType,string $remark = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->userType = $userType;
        $this->remark = $remark;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set the value of userType
     *
     * @return  self
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Set the value of remark
     *
     * @return  self
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of userType
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Get the value of remark
     */
    public function getRemark()
    {
        return $this->remark;
    }
}
