<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\OutputPageDto;
use App\Enums\ListOrderByType;
use Illuminate\Validation\Rules\Enum;

use Illuminate\Support\Facades\Validator;

use Exception;
use Illuminate\Validation\ValidationException;

class UtilService
{
    public function __construct()
    {
    }

    public function initPage($data): InputPageDto
    {
        //驗證
        $validator = Validator::make($data, [
            'page' => 'numeric|min:1',
            'pageCount' => 'numeric|min:0',
            'count' => 'numeric|min:0',
            'limit' => 'numeric|min:1',
            'search' => 'array',
            'sort' => [new Enum(ListOrderByType::class)],
            'sortColumn' => 'string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $page = (is_array($data)) ? (object)$data : $data;

        $pageData = new InputPageDto(
            $page->page ?? 1,
            $page->pageCount ?? 0,
            $page->count ?? 0,
            $page->limit ?? 10,
            $page->search ?? [],
            $page->sort ?? ListOrderByType::Desc->value,
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
}
