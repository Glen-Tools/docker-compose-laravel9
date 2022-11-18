<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputUserDto;
use App\Dto\InputUserPasswordDto;
use App\Dto\OutputPageDto;
use App\Dto\InputUserInfoDto;
use App\Enums\ListType;
use App\Enums\UserType;
use App\Repositories\UserRepository;
use App\Repositories\RoleUserRepository;
use App\Exceptions\ParameterException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class UserService
{
    protected $userRepository;
    protected $roleUserRepository;
    protected $utilService;

    public function __construct(
        UserRepository $userRepository,
        RoleUserRepository $roleUserRepository,
        UtilService $utilService
    ) {
        $this->userRepository = $userRepository;
        $this->roleUserRepository = $roleUserRepository;
        $this->utilService = $utilService;
    }

    public function createUser(InputUserDto $userDto)
    {
        $this->userRepository->createUser($userDto);
    }

    public function updateUser(InputUserDto $userDto, int $id)
    {
        $this->userRepository->updateUser($userDto, $id);
    }

    public function updateUserPassword(InputUserInfoDto $userInfo, InputUserPasswordDto $userDto, int $id)
    {
        // 確認身份
        if (($userInfo->getUserType() != UserType::Admin->value)) {
            throw new ParameterException(trans('error.user_authority_insufficinet'), Response::HTTP_UNAUTHORIZED);
        }

        // 確認新密碼
        if (($userDto->newPassword != $userDto->checkPassword)) {
            throw new ParameterException(trans('error.password'), Response::HTTP_BAD_REQUEST);
        }

        $this->userRepository->updateUserPassword($userDto->newPassword, $id);
    }

    public function updateSelfPassword(InputUserInfoDto $userInfo, InputUserPasswordDto $userDto)
    {
        // 確認新密碼
        if (($userDto->newPassword != $userDto->checkPassword)) {
            throw new ParameterException(trans('error.password'), Response::HTTP_BAD_REQUEST);
        }

        $this->userRepository->updateUserPassword($userDto->newPassword, $userInfo->getId());
    }

    public function getUserById(int $id): Collection
    {
        $data = $this->userRepository->getUserById($id);

        if (empty($data->toArray())) {
            throw new ParameterException(trans('error.user_not_found'), Response::HTTP_BAD_REQUEST);
        }

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
            $user->remark = $item->remark;
            return $user;
        });
        return $data;
    }

    public function getUserList(InputPageDto $pageManagement): Collection
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
        DB::transaction(function () use ($id) {
            $this->roleUserRepository->deleteRoleUserByUserId($id);
            $this->userRepository->deleteUserById($id);
        });
    }
}
