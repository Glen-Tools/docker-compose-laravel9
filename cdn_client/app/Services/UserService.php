<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputUserDto;
use App\Dto\OutputPageDto;
use App\Enums\ListType;
use App\Exceptions\ParameterException;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use stdClass;

class UserService
{
    protected $userRepository;
    protected $utilService;

    public function __construct(
        UserRepository $userRepository,
        UtilService $utilService
    ) {
        $this->userRepository = $userRepository;
        $this->utilService = $utilService;
    }

    public function createUser(InputUserDto $userDto)
    {
        $this->userRepository->createUser($userDto);
    }

    public function updateUser(InputUserDto $userDto, int $id)
    {
        $user = $this->userRepository->getUserByAccount($userDto->getEmail());
        if (isset($user) && $user->id != $id) {
            throw new ParameterException(trans('error.create_login_name_duplicate'), Response::HTTP_BAD_REQUEST);
        }
        $this->userRepository->updateUser($userDto, $id);
    }

    public function getUserById(int $id)
    {
        $data = $this->userRepository->getUserById($id);
        $data->transform(function ($item) {
            $user = new stdClass();
            $user->id = $item->id;
            $user->name = $item->name;
            $user->email = $item->email;
            $user->status = $item->status;
            $user->userType = $item->user_type;
            $user->loginIp = $item->login_ip;
            $user->passwordUpdateTime = $item->password_update_time;
            $user->loginTime = $item->login_time;
            $user->createdAt = $item->created_at;
            $user->updatedAt = $item->updated_at;
            return $user;
        });
        return $data;
    }

    public function getUserList(InputPageDto $pageManagement)
    {
        $data = $this->userRepository->getUserListByPage($pageManagement, ListType::ListData);

        $data->transform(function ($item) {
            $user = new stdClass();
            $user->id = $item->id;
            $user->name = $item->name;
            $user->email = $item->email;
            $user->status = $item->status;
            $user->userType = $item->user_type;
            $user->loginIp = $item->login_ip;
            $user->loginTime = $item->login_time;
            $user->createdAt = $item->created_at;
            $user->updatedAt = $item->updated_at;
            return $user;
        });

        return  $data;
    }

    public function getUserPage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->userRepository->getUserListByPage($pageManagement, ListType::ListCount);
        $pageCount = ceil($count / $pageManagement->getLimit());
        $pageManagement->setCount($count);
        $pageManagement->setPageCount($pageCount);

        $page = $this->utilService->setOutputPageDto($pageManagement);
        return $page;
    }

    public function deleteUserById(int $id)
    {
        $this->userRepository->deleteUserById($id);
    }
}
