<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Enums\ListOrderByType;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Exception;

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
            'pageCount' => 'numeric||min:0',
            'count' => 'numeric|min:0',
            'limit' => 'numeric|min:1',
            'search' => 'array',
            'sort' => 'string',
            'sortColumn' => 'string',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }

        $page = (is_array($data)) ? (object)$data : $data;
        $page->sort = (isset($page) && $page->sort == ListOrderByType::Desc->value) ? ListOrderByType::Desc->value : ListOrderByType::Asc->value;

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
}
