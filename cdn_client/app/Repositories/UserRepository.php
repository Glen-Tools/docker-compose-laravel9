<?php

namespace App\Repositories;

use App\Dto\InputPageDto;
use App\Dto\InputUserDto;
use App\Enums\ListType;
use App\Exceptions\ParameterException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleUser;

class UserRepository extends BaseRepository
{
    protected User $user;
    const HASH_OPTION = ['rounds' => 12];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser(InputUserDto $userDto)
    {
        $this->user->name = $userDto->name;
        $this->user->email = $userDto->email;
        $this->user->password = $this->getPasswordHash($userDto->password);
        $this->user->status = $userDto->status;
        $this->user->user_type = $userDto->userType;
        $this->user->remark = $userDto->remark;
        $this->user->save();
    }

    public function updateUser(InputUserDto $userDto, int $id)
    {
        $user = $this->isExistUser($id);

        $user->name = $userDto->name ?? $user->name;
        $user->email = $userDto->email ?? $user->email;
        $user->status = $userDto->status ?? $user->status;
        $user->user_type = $userDto->userType ?? $user->userType;
        $user->remark = $userDto->remark ?? $user->remark;
        $user->save();
    }

    public function updateUserPassword(string $password, int $id)
    {
        $user = $this->isExistUser($id);
        $user->password = $this->getPasswordHash($password);
        $user->save();
    }

    private function isExistUser(int $id): mixed
    {
        $user = $this->user->find($id);
        if (empty($user)) {
            throw new ParameterException(trans('error.user_not_found'), Response::HTTP_BAD_REQUEST);
        }

        return   $user;
    }

    public function getUserById(int $id)
    {
        return  $this->user->select(
            "id",
            "name",
            "email",
            "password_update_time",
            "status",
            "user_type",
            "login_ip",
            "login_time",
            "remark",
            "created_at",
            "updated_at"
        )->where("id", $id)->get();
    }

    public function getUserListByPage(InputPageDto $inPageManagement, ListType $type)
    {
        $Page = $inPageManagement->getPage();
        $Limit = $inPageManagement->getLimit();
        $Sort = $inPageManagement->getSort();
        $SortColumn = $inPageManagement->getSortColumn();
        $Search = $inPageManagement->getSearch();

        //搜尋項目
        $userOrm = $this->user->select("id", "name", "email", "status", "user_type", "login_ip", "login_time", "created_at", "updated_at");

        //where 條件
        $userTypeWhere = array("name" => "name", "email" => "email", "status" => "status", "userType" => "user_type");
        $userOrm = (isset($Search["status"])) ? $userOrm->where($userTypeWhere["status"], $Search["status"]) : $userOrm;
        $userOrm = (isset($Search["name"])) ? $userOrm->where($userTypeWhere["name"], "like", $this->stringMixLike($Search["name"])) : $userOrm;
        $userOrm = (isset($Search["email"])) ? $userOrm->where($userTypeWhere["email"], "like", $this->stringMixLike($Search["email"])) : $userOrm;
        $userOrm = (isset($Search["user_type"])) ? $userOrm->where($userTypeWhere["user_type"], "like", $this->stringMixLike($Search["user_type"])) : $userOrm;

        //判斷是否取總數
        $isGetListCount = $this->isGetListCount($type);
        if ($isGetListCount) {
            return $userOrm->select("id")->count();
        }

        //排序
        $orderByColums = array_merge($userTypeWhere, array("loginIp" => "login_ip", "loginTime" => "login_time", "createdAt" => "created_at", "updatedAt" => "updated_at"));
        if ($Sort != "" && $SortColumn != "" && in_array($SortColumn, array_keys($orderByColums))) {
            $userOrm = $userOrm->orderBy($orderByColums[$SortColumn], $Sort);
        } else {
            $userOrm = $userOrm->orderBy("id", $Sort);
            $inPageManagement->setSortColumn("id");
            $inPageManagement->setSort($Sort);
        }

        //筆數
        $userOrm = $userOrm->offset(($Page - 1) * $Limit);
        $userOrm = $userOrm->limit($Limit);

        return $userOrm->get();
    }

    public function deleteUserById($id)
    {
        RoleUser::where("user_id", $id)->delete();
        $this->user->destroy($id);
    }

    public function getUserByAccount(string $account)
    {
        //account = email
        return $this->user->select("id", "name", "email", "user_type")->where("email", $account)->first();
    }

    public function validPassword(int $id, string $passowrd): bool
    {
        $user = $this->user->select("password")->where("id", $id)->first();
        return Hash::check($passowrd, $user->password, $this::HASH_OPTION);
    }

    private function getPasswordHash(string $passowrd)
    {
        return Hash::make($passowrd, $this::HASH_OPTION);
    }

    public function getUserMenu(int $id): Collection
    {
        return $this->user
            ->join('role_user as ru', 'ru.user_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->join('role_menu as rm', 'rm.role_id', '=', 'r.id')
            ->join('menus as m', 'm.id', '=', 'rm.menu_id')
            ->where('users.id', $id)
            ->where('users.status', 1)
            ->where('r.status', 1)
            ->where('m.status', 1)
            ->orderBy("m.parent", "asc")
            ->orderBy("m.weight", "desc")
            ->orderBy("m.id", "asc")
            ->select("m.id", "m.name", "m.key", "m.url", "m.feature", "m.status", "m.parent", "m.weight")
            ->distinct("m.id")
            ->get();
    }


    public function testDbTooRawSql()
    {
        return DB::table('user')->select("id", "name")->where("id", 1)->toBoundSql();
    }

    public function testOrmtoRawSql()
    {
        return User::select("id", "name")->where("id", 1)->toBoundSql();
    }
}
