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
        $this->ColumnValidator($data, [
            'page' => 'integer|min:1',
            'pageCount' => 'integer|min:0',
            'count' => 'integer|min:0',
            'limit' => 'integer|min:1',
            'search' => 'array',
            'sort' => 'string|nullable',
            'sortColumn' => 'string|nullable',
        ]);

        $page = (is_array($data)) ? (object)$data : $data;
        $page->sort = (empty($page->sort) || $page->sort != ListOrderByType::Desc->value) ? ListOrderByType::Asc->value : ListOrderByType::Desc->value;

        $pageData = new InputPageDto(
            $page->page ?? 1,
            $page->pageCount ?? 0,
            $page->count ?? 0,
            $page->limit ?? 10,
            $page->search ?? [],
            $page->sort,
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
}
