<?php

namespace App\Dto;

class OutputUserListDto
{
    public $userList;
    public $pageManagement;

    public function __construct($userList, OutputPageDto $pageManagement)
    {
        $this->userList = $userList;
        $this->pageManagement = $pageManagement;
    }
}
