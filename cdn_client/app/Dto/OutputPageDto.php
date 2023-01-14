<?php

namespace App\Dto;

class OutputPageDto
{
    public ?int $page;
    public ?int $pageCount;
    public ?int $count;
    public ?int $limit;
    public ?array $search;
    public ?string $sort;
    public ?string $sortColumn;

    public function __construct(int $page,int $pageCount,int $count,int $limit,array $search,string $sort,string $sortColumn)
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
