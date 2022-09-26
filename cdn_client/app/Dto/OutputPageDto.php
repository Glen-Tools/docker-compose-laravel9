<?php

namespace App\Dto;

class OutputPageDto
{
    public $page;
    public $pageCount;
    public $count;
    public $limit;
    public $search;
    public $sort;
    public $sortColumn;

    public function __construct($page, $pageCount, $count, $limit, $search, $sort, $sortColumn)
    {
        $this->page = $page;
        $this->pageCount = $pageCount;
        $this->count = $count;
        $this->limit = $limit;
        $this->search = $search;
        $this->sort = $sort;
        $this->sortColumn = $sortColumn;
    }

}
