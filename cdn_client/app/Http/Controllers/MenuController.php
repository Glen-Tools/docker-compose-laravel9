<?php

namespace App\Http\Controllers;

use App\Dto\InputMenuDto;
use App\Dto\OutputResponseDto;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MenuController extends Controller
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
            'name' => 'required|unique:menus|max:100',
            'key' => 'required|unique:menus|max:150',
            'url' => 'required|max:500',
            'feature' => ['required', 'max:10', Rule::in(['T', 'P','F'])],
            'status' => 'required|boolean',
            'parent' => 'numeric',
            'remark' => 'max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $menuDto = new InputMenuDto(
            $data["name"],
            $data["key"],
            $data["url"],
            $data["feature"],
            $data["status"],
            $data["parent"],
            $data["weight"],
            $data["remark"] ?? "",
        );

        $this->menuService->create($menuDto);
        $responseDto = new OutputResponseDto();
        return response()->json($responseDto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
