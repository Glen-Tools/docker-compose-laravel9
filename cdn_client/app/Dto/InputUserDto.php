<?php

namespace App\Dto;

class InputUserDto
{
    protected $name;
    protected $email;
    protected $password;
    protected $status;
    protected $user_type;
    protected $remark;

    public function __construct($name, $email, $password, $status, $user_type, $remark = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->user_type = $user_type;
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
     * Set the value of user_type
     *
     * @return  self
     */
    public function setUser_type($user_type)
    {
        $this->user_type = $user_type;

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
     * Get the value of user_type
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Get the value of remark
     */
    public function getRemark()
    {
        return $this->remark;
    }
}
