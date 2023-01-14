<?php

namespace App\Dto;

class InputLogDto
{
    public readonly ?string $url;
    public readonly ?string $method;
    public readonly ?string $feature;
    public readonly ?string $content;
    public readonly ?string $operate;
    public readonly ?string $ip;
    public readonly ?int $userId;

    public function __construct(string $url, string $method, string $feature, string $ip, string $operate, int $userId, string $content)
    {
        $this->url = $url;
        $this->method = $method;
        $this->feature = $feature;
        $this->ip = $ip;
        $this->userId = $userId;
        $this->content = $content;
        $this->operate = $operate;
    }
}
