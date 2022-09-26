<?php

namespace App\Http\Controllers;

use App\Dto\InputUserDto;
use App\Dto\OutputUserListDto;
use App\Services\ResponseService;
use App\Services\UserService;
use App\Services\UtilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $validator = Validator::make($data, [
            'name' => 'required|max:50',
            'email' => 'required|unique:users|max:100|email:rfc,dns',
            'password' => 'required|max:50',
            'status' => 'required|boolean',
            'user_type' => ['required', Rule::in([1, 2])], //管理者=1,一般使用者=2
            'remark' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $userDto = new InputUserDto(
            $data["name"],
            $data["email"],
            $data["password"],
            $data["status"],
            $data["user_type"],
            $data["remark"] ?? "",
        );

        $this->userService->create($userDto);
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
        $data = $this->userService->getUser($id);
        return $this->responseService->responseJson($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
