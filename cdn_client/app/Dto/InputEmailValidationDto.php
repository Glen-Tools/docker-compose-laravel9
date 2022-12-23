<?php

namespace App\Dto;

class InputEmailValidationDto
{
    public readonly ?string $view;
    public readonly ?string $subject;
    public readonly ?string $title;
    public readonly ?string $content;

    public function __construct(string $view, string $subject, string $title, string $content)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->title = $title;
        $this->content = $content;
    }
}
