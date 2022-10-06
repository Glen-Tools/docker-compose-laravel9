<?php

namespace App\Dto;

class OutputLoginDto
{
    public $user;
    public $authorisation;

    public function __construct($user, OutputJwtDto $authorisation)
    {
        $this->user = $user;
        $this->authorisation = $authorisation;
    }
}
