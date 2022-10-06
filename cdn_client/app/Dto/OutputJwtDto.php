<?php

namespace App\Dto;

class OutputJwtDto
{
    public $tokenType;
    public $accessToken;
    public $refreshToken;

    public function __construct(string $accessToken, string $refreshToken, string $tokenType = "bearer")
    {
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }
}
