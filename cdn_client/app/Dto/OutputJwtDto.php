<?php

namespace App\Dto;

class OutputJwtDto
{
    public ?string $tokenType;
    public ?string $accessToken;
    public ?string $refreshToken;

    public function __construct(string $accessToken,string $refreshToken,string $tokenType = "bearer")
    {
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }
}
