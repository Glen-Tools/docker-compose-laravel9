<?php

namespace App\Dto;

class InputPageDto
{
    protected $page;
    protected $pageCount;
    protected $count;
    protected $limit;
    protected $search;
    protected $sort;
    protected $sortColumn;

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


    /**
     * Set the value of page
     *
     * @return  self
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Set the value of pageCount
     *
     * @return  self
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * Set the value of count
     *
     * @return  self
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Set the value of search
     *
     * @return  self
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Set the value of sort
     *
     * @return  self
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Set the value of sortColumn
     *
     * @return  self
     */
    public function setSortColumn($sortColumn)
    {
        $this->sortColumn = $sortColumn;

        return $this;
    }

    /**
     * Get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get the value of pageCount
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Get the value of count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get the value of limit
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Get the value of search
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Get the value of sort
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Get the value of sortColumn
     */
    public function getSortColumn()
    {
        return $this->sortColumn;
    }
}
