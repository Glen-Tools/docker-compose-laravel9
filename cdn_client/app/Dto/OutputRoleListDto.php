<?php

namespace App\Dto;

class OutputRoleListDto
{
    public mixed $roleList;
    public mixed $pageManagement;

    public function __construct(mixed $roleList, OutputPageDto $pageManagement)
    {
        $this->roleList = $roleList;
        $this->pageManagement = $pageManagement;
    }
}
