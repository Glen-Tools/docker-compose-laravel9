<?php

namespace App\Dto;

class InputLogDto
{
    public readonly ?string $feature;
    public readonly ?string $operate;
    public readonly ?string $table;
    public readonly ?string $content;
    public readonly ?int $userId;

    public function __construct(string $feature, string $operate, string $table, string $content, int $userId)
    {
        $this->feature = $feature;
        $this->operate = $operate;
        $this->table = $table;
        $this->content = $content;
        $this->userId = $userId;
    }
}
