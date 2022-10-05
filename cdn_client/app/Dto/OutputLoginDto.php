<?php

namespace App\Dto;

class OutputLoginDto
{
    public $user;
    public $jwt;
    public $refreshJwt;

    public function __construct($user, OutputJwtDto $authorisation)
    {
        $this->user = $user;
        $this->authorisation = $authorisation;
    }
}
