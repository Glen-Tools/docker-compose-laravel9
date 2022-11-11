<?php

namespace App\Dto;

class InputUserPasswordDto
{
    protected ?string $password;
    protected ?string $newPassord;
    protected ?string $checkPassord;


    public function __construct(string $password, string $newPassord, string $checkPassord)
    {
        $this->password = $password;
        $this->newPassord = $newPassord;
        $this->checkPassord = $checkPassord;
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
     * Set the value of newPassord
     *
     * @return  self
     */
    public function setNewPassord($newPassord)
    {
        $this->newPassord = $newPassord;

        return $this;
    }

    /**
     * Set the value of checkPassord
     *
     * @return  self
     */
    public function setCheckPassord($checkPassord)
    {
        $this->checkPassord = $checkPassord;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of newPassord
     */
    public function getNewPassord()
    {
        return $this->newPassord;
    }

    /**
     * Get the value of checkPassord
     */
    public function getCheckPassord()
    {
        return $this->checkPassord;
    }
}
