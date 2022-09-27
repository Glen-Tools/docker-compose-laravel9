<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputUserDto;
use App\Dto\OutputPageDto;
use App\Dto\OutputUserListDto;
use App\Enums\ListType;
use App\Repositories\UserRepository;
use stdClass;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(InputUserDto $userDto)
    {
        $this->userRepository->createUser($userDto);
    }

    public function updateUser(InputUserDto $userDto, int $id)
    {
        $this->userRepository->updateUser($userDto, $id);
    }

    public function getUserById(int $id)
    {
        $data = $this->userRepository->getUserById($id);
        $data->transform(function ($item) {
            $item->userType = $item->user_type;
            $item->loginIp = $item->login_ip;
            $item->loginTime = $item->login_time;
            $item->password_update_time = $item->password_update_time;
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->user_type);
            unset($item->login_ip);
            unset($item->login_time);
            unset($item->password_update_time);
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });
        return $data;
    }

    public function getUserList(InputPageDto $pageManagement)
    {
        $data = $this->userRepository->getUserListByPage($pageManagement, ListType::ListData);

        $data->transform(function ($item) {
            $item->userType = $item->user_type;
            $item->loginIp = $item->login_ip;
            $item->loginTime = $item->login_time;
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->user_type);
            unset($item->login_ip);
            unset($item->login_time);
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });

        return  $data;
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
