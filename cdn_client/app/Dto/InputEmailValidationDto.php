<?php

namespace App\Dto;

class InputEmailValidationDto
{
    public readonly ?string $view;
    public readonly ?string $subject;
    public readonly ?string $content;

    public function __construct(string $view, string $subject, string $content)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->content = $content;
    }
}
