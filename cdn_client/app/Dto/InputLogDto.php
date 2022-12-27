<?php

namespace App\Dto;

class InputLogDto
{
    public readonly ?string $url;
    public readonly ?string $method;
    public readonly ?string $feature;
    public readonly ?string $operate;
    public readonly ?string $table;
    public readonly ?string $content;
    public readonly ?int $userId;

    public function __construct(string $url, string $method, string $feature, string $operate, string $table, string $content, int $userId)
    {
        $this->url = $url;
        $this->method = $method;
        $this->feature = $feature;
        $this->operate = $operate;
        $this->table = $table;
        $this->content = $content;
        $this->userId = $userId;
    }
}
