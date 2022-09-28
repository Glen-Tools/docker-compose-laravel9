<?php

namespace App\Http\Controllers;

use App\Dto\InputRoleDto;
use App\Dto\OutputRoleListDto;
use App\Services\ResponseService;
use App\Services\RoleService;
use App\Services\UtilService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleService;
    private $utilService;
    private $responseService;

    public function __construct(
        RoleService $roleService,
        UtilService $utilService,
        ResponseService $responseService
    ) {
        $this->roleService = $roleService;
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
        $roleList = $this->roleService->getRoleList($pageManagement);
        $rolePage = $this->roleService->getRolePage($pageManagement);

        $outputRoleListDto = new OutputRoleListDto($roleList, $rolePage);
        return $this->responseService->responseJson($outputRoleListDto);
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
        $this->utilService->ColumnValidator($data, [
            'name' => 'required|unique:roles|max:100',
            'key' => 'required|unique:roles|max:150',
            'status' => 'required|boolean',
            'weight' => 'integer',
            'remark' => 'string|max:5000'
        ]);

        $roleDto = new InputRoleDto(
            $data["name"],
            $data["key"],
            $data["status"],
            $data["weight"],
            $data["remark"] ?? "",
        );

        $this->roleService->createRole($roleDto);
        return $this->responseService->responseJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->roleService->getRoleById($id);
        return $this->responseService->responseJson($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'unique:roles|max:100',
            'key' => 'unique:roles|max:150',
            'status' => 'boolean',
            'weight' => 'integer',
            'remark' => 'string|max:5000'
        ]);

        $roleDto = new InputRoleDto(
            $data["name"],
            $data["key"],
            $data["status"],
            $data["weight"],
            $data["remark"] ?? "",
        );

        $this->roleService->updateRole($roleDto, $id);
        return $this->responseService->responseJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleService->deleteRoleById($id);
        return $this->responseService->responseJson();
    }
}
