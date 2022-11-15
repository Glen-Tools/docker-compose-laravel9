<?php

namespace App\Dto;

class InputUserInfoDto
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly int $userType;

    public function __construct(int $id, string $name, string $email, int $userType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->userType = $userType;
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
