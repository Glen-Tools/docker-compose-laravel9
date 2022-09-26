<?php

namespace App\Http\Controllers;

use App\Dto\InputRoleDto;
use App\Dto\OutputResponseDto;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|unique:roles|max:100',
            'key' => 'required|unique:roles|max:150',
            'status' => 'required|boolean',
            'remark' => 'max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $roleDto = new InputRoleDto(
            $data["name"],
            $data["key"],
            $data["status"],
            $data["weight"],
            $data["remark"] ?? "",
        );

        $this->roleService->create($roleDto);
        $responseDto = new OutputResponseDto();
        return response()->json($responseDto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
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
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
