<?php

namespace App\Http\Controllers;

use App\Dto\InputMenuDto;
use App\Dto\OutputMenuListDto;
use App\Services\ResponseService;
use App\Services\MenuService;
use App\Services\UtilService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends BaseController
{
    private $menuService;
    private $utilService;
    private $responseService;

    public function __construct(
        MenuService $menuService,
        UtilService $utilService,
        ResponseService $responseService
    ) {
        $this->menuService = $menuService;
        $this->utilService = $utilService;
        $this->responseService = $responseService;
    }

    /**
     * @OA\Get(
     *  tags={"Menu"},
     *  path="/api/v1/menu",
     *  summary="Menu清單 (Menu List)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="query",name="page",description="頁數",@OA\Schema(type="integer",default="1")),
     *  @OA\Parameter(parameter="pageCount",in="query",name="pageCount",description="總頁數",@OA\Schema(type="integer")),
     *  @OA\Parameter(parameter="count",in="query",name="count",description="總筆數",@OA\Schema(type="integer")),
     *  @OA\Parameter(parameter="limit",in="query",name="limit",description="每頁筆數",@OA\Schema(type="integer",default="10")),
     *  @OA\Parameter(parameter="search",in="query",name="search[name]",description="搜尋條件",@OA\Schema(type="string")),
     *  @OA\Parameter(parameter="search",in="query",name="search[url]",description="搜尋條件",@OA\Schema(type="string")),
     *  @OA\Parameter(parameter="sort",in="query",name="sort",description="排序", explode=true,
     *      @OA\Schema(type="string",enum = \App\Enums\ListOrderByType::class)),
     *  @OA\Parameter(parameter="sortColumn",in="query",name="sortColumn",description="排序欄位", explode=true,
     *      @OA\Schema(type="string",enum = {"id","name","url","feature","status","parent","weight","createdAt","updatedAt"})),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/ShowMenuList", example="ShowMenuList")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     * @return OutputMenuListDto
     */
    public function index(Request $request)
    {
        //取得api data
        $data = $request->query();

        //頁數初始化
        $pageManagement = $this->utilService->initPage($data ?? null);

        //取得List, page
        $menuList = $this->menuService->getMenuList($pageManagement);
        $menuPage = $this->menuService->getMenuPage($pageManagement);

        $outputMenuListDto = new OutputMenuListDto($menuList, $menuPage);
        return $this->responseService->responseJson($outputMenuListDto);
    }

    /**
     * @OA\Get(
     *  tags={"Menu"},
     *  path="/api/v1/menu/{id}",
     *  summary="Menu資料 (Menu Info)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="path",name="id",required=true,description="id",@OA\Schema(type="integer")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/ShowMenuById", example="ShowMenuById")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function store(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'required|unique:menus|max:100',
            'key' => 'required|unique:menus|max:150',
            'url' => 'required|max:500',
            'feature' => ['required', 'max:10', Rule::in(['T', 'P', 'F'])],
            'status' => 'required|boolean',
            'parent' => 'integer|nullable',
            'weight' => 'integer|nullable',
            'remark' => 'string|max:5000|nullable'
        ]);

        $menuDto = new InputMenuDto(
            $data["name"],
            $data["key"],
            $data["url"],
            $data["feature"],
            $data["status"],
            $data["parent"] ?? 0,
            $data["weight"] ?? null,
            $data["remark"] ?? "",
        );

        $this->menuService->createMenu($menuDto);
        return $this->responseService->responseJson();
    }

    /**
     * @OA\Post(
     *  tags={"Menu"},
     *  path="/api/v1/menu",
     *  summary="新增Menu(Menu Create)",
     *  security={{"Authorization":{}}},
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/CreateMenu")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=401,description="Unauthorized",@OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function show(Request $request, $id)
    {
        parent::show($request, $id);
        $data = $this->menuService->getMenuById($id);
        return $this->responseService->responseJson($data);
    }

    /**
     * @OA\Put(
     *  tags={"Menu"},
     *  path="/api/v1/menu/{id}",
     *  summary="修改Menu(Menu Update)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="path",name="id",required=true,description="id",@OA\Schema(type="integer")),
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/UpdateMenu")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=401,description="Unauthorized",@OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function update(Request $request, $id)
    {
        parent::update($request, $id);

        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'required|max:100|unique:menus,name,' . $id, //當id不存在,在debug模式會顯示name 已經存在
            'key' => 'required|max:150|unique:menus,key,' . $id, //當id不存在,在debug模式會顯示key 已經存在
            'url' => 'required|max:500',
            'feature' => ['required', 'max:10', Rule::in(['T', 'P', 'F'])],
            'status' => 'required|boolean',
            'parent' => 'integer|nullable',
            'weight' => 'integer|nullable',
            'remark' => 'string|max:5000|nullable'
        ]);

        $menuDto = new InputMenuDto(
            $data["name"],
            $data["key"],
            $data["url"],
            $data["feature"],
            $data["status"],
            $data["parent"] ?? 0,
            $data["weight"] ?? null,
            $data["remark"] ?? "",
        );

        $this->menuService->updateMenu($menuDto, $id);
        return $this->responseService->responseJson();
    }

    /**
     * @OA\Delete(
     *  tags={"Menu"},
     *  path="/api/v1/menu/{id}",
     *  summary="刪除Menu(Menu Delete)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="path",name="id",required=true,description="id",@OA\Schema(type="integer")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=401,description="Unauthorized",@OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function destroy(Request $request, $id)
    {
        parent::destroy($request, $id);
        $this->menuService->deleteMenuById($id);
        return $this->responseService->responseJson();
    }
}
