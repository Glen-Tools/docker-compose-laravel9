<?php

namespace App\Dto;

class OutputRoleListDto
{
    public $roleList;
    public $pageManagement;

    public function __construct($roleList, OutputPageDto $pageManagement)
    {
        $this->roleList = $roleList;
        $this->pageManagement = $pageManagement;
    }
}
