<?php

namespace App\Repositories;

use App\Dto\InputPageDto;
use App\Dto\InputMenuDto;
use App\Enums\ListType;
use App\Exceptions\ParameterException;
use App\Models\Menu;
use Illuminate\Http\Response;

class MenuRepository extends BaseRepository
{
    protected Menu $menu;

    const HASH_OPTION = ['rounds' => 12];

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function createMenu(InputMenuDto $menuDto)
    {
        $this->menu->name = $menuDto->getName();
        $this->menu->key = $menuDto->getKey();
        $this->menu->url = $menuDto->getUrl();
        $this->menu->feature = $menuDto->getFeature();
        $this->menu->status = $menuDto->getStatus();
        $this->menu->parent = $menuDto->getParent();
        $this->menu->weight = $menuDto->getWeight();
        $this->menu->remark = $menuDto->getRemark();
        $this->menu->save();
    }

    public function updateMenu(InputMenuDto $menuDto, int $id)
    {
        $menu = $this->menu->find($id);

        if (empty($menu)) {
            throw new ParameterException(trans('error.data_not_found', ['title' => 'Menu']), Response::HTTP_BAD_REQUEST);
        }

        $menu->name = $menuDto->getName() ?? $menu->name;
        $menu->key = $menuDto->getKey() ?? $menu->key;
        $menu->url = $menuDto->getUrl() ?? $menu->url;
        $menu->feature = $menuDto->getFeature() ?? $menu->feature;
        $menu->status = $menuDto->getStatus() ?? $menu->status;
        $menu->parent = $menuDto->getParent() ?? $menu->parent;
        $menu->weight = $menuDto->getWeight() ?? $menu->weight;
        $menu->remark = $menuDto->getRemark() ?? $menu->remark;
        $menu->save();
    }

    public function getMenuById(int $id)
    {
        return  $this->menu->select(
            "id",
            "name",
            "key",
            "url",
            "feature",
            "status",
            "parent",
            "weight",
            "remark",
            "created_at",
            "updated_at"
        )->where("id", $id)->get();
    }

    public function getMenuListByPage(InputPageDto $inPageManagement, ListType $type)
    {
        $Page = $inPageManagement->getPage();
        $Limit = $inPageManagement->getLimit();
        $Sort = $inPageManagement->getSort();
        $SortColumn = $inPageManagement->getSortColumn();
        $Search = $inPageManagement->getSearch();

        //搜尋項目
        $menuOrm = $this->menu->select("id", "name", "key", "url", "feature", "status", "parent", "weight", "created_at", "updated_at");

        //where 條件
        $menuTypeWhere = array("name" => "name", "key" => "key", "url" => "url", "feature" => "feature", "status" => "status", "parent" => "parent");
        $menuOrm = (isset($Search["status"])) ? $menuOrm->where($menuTypeWhere["status"], $Search["status"]) : $menuOrm;
        $menuOrm = (isset($Search["name"])) ? $menuOrm->where($menuTypeWhere["name"], "like", $this->stringMixLike($Search["name"])) : $menuOrm;
        $menuOrm = (isset($Search["url"])) ? $menuOrm->where($menuTypeWhere["url"], "like", $this->stringMixLike($Search["url"])) : $menuOrm;
        $menuOrm = (isset($Search["feature"])) ? $menuOrm->where($menuTypeWhere["feature"], "like", $this->stringMixLike($Search["feature"])) : $menuOrm;

        //判斷是否取總數
        $isGetListCount = $this->isGetListCount($type);
        if ($isGetListCount) {
            return $menuOrm->select("id")->count();
        }

        //排序
        $orderByColums = array_merge($menuTypeWhere, array("weight" => "weight", "createdAt" => "created_at", "updatedAt" => "updated_at"));
        if ($Sort != "" && $SortColumn != "" && in_array($SortColumn, array_keys($orderByColums))) {
            $menuOrm = $menuOrm->orderBy($orderByColums[$SortColumn], $Sort);
        } else {
            $menuOrm = $menuOrm->orderBy("id", $Sort);
        }

        //筆數
        $menuOrm = $menuOrm->offset(($Page - 1) * $Limit);
        $menuOrm = $menuOrm->limit($Limit);

        return $menuOrm->get();
    }

    public function deleteMenuById($id)
    {
        $this->menu->destroy($id);
    }
}
