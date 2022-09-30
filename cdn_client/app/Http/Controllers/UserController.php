<?php

namespace App\Http\Controllers;

use App\Dto\InputUserDto;
use App\Dto\OutputUserListDto;
use App\Services\ResponseService;
use App\Services\UserService;
use App\Services\UtilService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    private $userService;
    private $utilService;
    private $responseService;

    public function __construct(
        UserService $userService,
        UtilService $utilService,
        ResponseService $responseService
    ) {
        $this->userService = $userService;
        $this->utilService = $utilService;
        $this->responseService = $responseService;
    }

    /**
     * @OA\Get(
     *  tags={"User"},
     *  path="/api/v1/user",
     *  summary="使用者清單 (User List)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="query",name="page",description="頁數",@OA\Schema(type="integer",default="1")),
     *  @OA\Parameter(parameter="pageCount",in="query",name="pageCount",description="總頁數",@OA\Schema(type="integer")),
     *  @OA\Parameter(parameter="count",in="query",name="count",description="總筆數",@OA\Schema(type="integer")),
     *  @OA\Parameter(parameter="limit",in="query",name="limit",description="每頁筆數",@OA\Schema(type="integer",default="10")),
     *  @OA\Parameter(parameter="search",in="query",name="search[name]",description="搜尋條件",@OA\Schema(type="string")),
     *  @OA\Parameter(parameter="search",in="query",name="search[email]",description="搜尋條件",@OA\Schema(type="string")),
     *  @OA\Parameter(parameter="sort",in="query",name="sort",description="排序", explode=true,
     *      @OA\Schema(type="string",default="asc",enum = {"asc","desc"})),
     *  @OA\Parameter(parameter="sortColumn",in="query",name="sortColumn",description="排序欄位", explode=true,
     *      @OA\Schema(type="string",default="id",enum = {"id","name","email","status","userType","loginIp","loginTime","createdAt","updatedAt"})),
     *  @OA\Response(response=200,description="OK"),
     *  @OA\Response(response=401,description="Unauthorized"),
     *  @OA\Response(response=404,description="Not Found")
     * )
     * @return OutputUserListDto
     */
    public function index(Request $request)
    {
        //取得api data
        $data = $request->query();

        //頁數初始化
        $pageManagement = $this->utilService->initPage($data ?? null);

        //取得List, page
        $userList = $this->userService->getUserList($pageManagement);
        $userPage = $this->userService->getUserPage($pageManagement);

        $outputUserListDto = new OutputUserListDto($userList, $userPage);
        return $this->responseService->responseJson($outputUserListDto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'required|max:50',
            'email' => 'required|unique:users|max:100|email:rfc,dns',
            'password' => 'required|max:50',
            'status' => 'required|boolean',
            'user_type' => ['required', Rule::in([1, 2])], //管理者=1,一般使用者=2
            'remark' => 'string|max:5000|nullable',
        ]);

        $userDto = new InputUserDto(
            $data["name"],
            $data["email"],
            $data["password"],
            $data["status"],
            $data["user_type"],
            $data["remark"] ?? "",
        );

        $this->userService->createUser($userDto);
        return $this->responseService->responseJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->userService->getUserById($id);
        return $this->responseService->responseJson($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'max:50',
            'email' => 'max:100|email:rfc,dns|unique:users,email,' . $id,
            'status' => 'boolean',
            'user_type' => [Rule::in([1, 2])], //管理者=1,一般使用者=2
            'remark' => 'string|max:5000|nullable',
        ]);

        $userDto = new InputUserDto(
            $data["name"],
            $data["email"],
            "",
            $data["status"],
            $data["user_type"],
            $data["remark"] ?? "",
        );

        $this->userService->updateUser($userDto, $id);
        return $this->responseService->responseJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->deleteUserById($id);
        return $this->responseService->responseJson();
    }
}
