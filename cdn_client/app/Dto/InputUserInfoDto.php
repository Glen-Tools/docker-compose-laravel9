<?php

namespace App\Dto;

class InputUserInfoDto
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $email;
    protected ?string $userType;

    public function __construct(int $id,string $name,string $email,string $userType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->userType = $userType;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of userType
     */
    public function getUserType()
    {
        return $this->userType;
    }
}
