<?php

namespace App\Dto;

class OutputUserListDto
{
    public mixed $userList;
    public mixed $pageManagement;

    public function __construct(mixed $userList, OutputPageDto $pageManagement)
    {
        $this->userList = $userList;
        $this->pageManagement = $pageManagement;
    }
}
