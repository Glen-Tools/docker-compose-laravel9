<?php

namespace App\Dto;

class OutputMenuListDto
{
    public $menuList;
    public $pageManagement;

    public function __construct($menuList, OutputPageDto $pageManagement)
    {
        $this->menuList = $menuList;
        $this->pageManagement = $pageManagement;
    }
}
