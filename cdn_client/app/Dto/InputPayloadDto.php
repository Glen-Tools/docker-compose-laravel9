<?php

namespace App\Dto;

class InputPayloadDto
{
    public readonly ?string $iss;
    public readonly int $exp;
    public readonly int $nbf;
    public readonly ?int $iat;
    public readonly ?string $tokenType;
    public readonly int $userId;


    public function __construct(string $iss, int $exp, int $nbf, int $iat, string $tokenType, int $userId)
    {
        $this->iss = $iss;
        $this->exp = $exp;
        $this->nbf = $nbf;
        $this->iat = $iat;
        $this->tokenType = $tokenType;
        $this->userId = $userId;
    }
}
