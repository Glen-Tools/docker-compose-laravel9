<?php

namespace App\Dto;

class OutputMenuListDto
{
    public mixed $menuList;
    public mixed $pageManagement;

    public function __construct(mixed $menuList, OutputPageDto $pageManagement)
    {
        $this->menuList = $menuList;
        $this->pageManagement = $pageManagement;
    }
}
