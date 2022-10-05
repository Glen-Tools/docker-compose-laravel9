<?php

namespace App\Dto;

class OutputJwtDto
{
    public $tokenType;
    public $accessToken;
    public $refreshToken;

    public function __construct(string $tokenType = "Bearer", string $accessToken, string $refreshToken)
    {
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }
}
