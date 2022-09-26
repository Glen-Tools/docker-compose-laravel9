<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputUserDto;
use App\Dto\OutputPageDto;
use App\Enums\ListType;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(InputUserDto $userDto)
    {
        $this->userRepository->createUser($userDto);
    }

    public function getUser(int $id)
    {
        $data = $this->userRepository->getUserById($id);
        return $data;
    }

    public function getUserList(InputPageDto $pageManagement)
    {
        $data = $this->userRepository->getUserListByPage($pageManagement, ListType::ListData);
        return $data;
    }

    public function getUserPage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->userRepository->getUserListByPage($pageManagement, ListType::ListCount);
        $pageCount = ceil($count / $pageManagement->getPageCount());

        $page = new OutputPageDto(
            $pageManagement->getPage(),
            $pageCount,
            $count,
            $pageManagement->getLimit(),
            $pageManagement->getSearch(),
            $pageManagement->getSort(),
            $pageManagement->getSortColumn()
        );
        return $page;
    }

    public function deleteUserById(int $id)
    {
        $this->userRepository->deleteUserById($id);
    }
}
