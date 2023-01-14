<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\OutputPageDto;
use App\Enums\ListOrderByType;
use Illuminate\Validation\Rules\Enum;

use Illuminate\Support\Facades\Validator;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UtilService
{
    public function __construct()
    {
    }

    public function initPage($data): InputPageDto
    {
        //驗證
        $this->ColumnValidator($data, [
            'page' => 'integer|min:1',
            'pageCount' => 'integer|min:0',
            'count' => 'integer|min:0',
            'limit' => 'integer|min:1',
            'search' => 'array',
            'sort' => [new Enum(ListOrderByType::class)],
            'sortColumn' => 'string',
        ]);

        $page = (is_array($data)) ? (object)$data : $data;

        $pageData = new InputPageDto(
            $page->page ?? 1,
            $page->pageCount ?? 0,
            $page->count ?? 0,
            $page->limit ?? 10,
            $page->search ?? [],
            $page->sort ?? ListOrderByType::Asc->value,
            $page->sortColumn ?? "",
        );
        return $pageData;
    }

    public function setOutputPageDto(InputPageDto $pageManagement): OutputPageDto
    {
        $page = new OutputPageDto(
            $pageManagement->getPage(),
            $pageManagement->getPageCount(),
            $pageManagement->getCount(),
            $pageManagement->getLimit(),
            $pageManagement->getSearch(),
            $pageManagement->getSort(),
            $pageManagement->getSortColumn()
        );
        return $page;
    }

    public function ColumnValidator($data, array $dataValidator)
    {

        //驗證
        $validator = Validator::make($data, $dataValidator);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * 判斷是否為 json 字串
     *
     * @since 1.03.22
     *
     * @link https://vector.cool/php-is-json/
     *
     * @param string|null $string = ""
     * @return bool
     */
    function isJson(?string $json_string = ""): bool
    {
        return is_string($json_string) &&
            is_array(json_decode($json_string, true)) &&
            (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }


    /**
     * arrayAppendToKeyValueArray
     * 合併兩個array (key,value)
     * @param  mixed $ray1
     * @param  mixed $ray2
     * @return void
     */
    function arrayAppendToKeyValueArray($ray1, $ray2)
    {
        $keys = array_merge(array_keys($ray1), array_keys($ray2));
        $vals = array_merge($ray1, $ray2);
        return array_combine($keys, $vals);
    }

    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }


    public function getTreeNodeList(Collection $nodes, array $selecteds): array
    {
        if (($key = array_search(0, $selecteds)) !== false) {
            unset($selecteds[$key]);
        }

        $data = [];
        foreach ($selecteds as $value) {
            $parents = [];
            $this->getTreeParents($nodes, $value, $parents);
            // Log::info("$value:" . implode(",", $parents));
            $data = array_unique(array_merge($data, $parents), SORT_NUMERIC);
            // Log::info($data);
        }
        return  $data;
    }

    public function getTreeParents(Collection $treeNodes, int $id, array &$parents)
    {
        $node = $treeNodes->firstWhere("id", $id);
        array_push($parents, $id);
        if (!empty($node->parent) && $node->parent != 0) {
            $this->getTreeParents($treeNodes, $node->parent, $parents);
        }
    }

    public function getStoreKeyValue(int $id, array $selecteds, string $keyName, string $valueName): array
    {
        $data = [];
        foreach ($selecteds as $value) {
            array_push($data, [$keyName => $id, $valueName => $value]);
        }
        return $data;
    }
}
