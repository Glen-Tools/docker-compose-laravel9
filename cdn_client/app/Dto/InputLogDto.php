<?php

namespace App\Dto;

class InputLogDto
{
    protected ?string $feature;
    protected ?string $operate;
    protected ?string $table;
    protected ?string $content;
    protected ?int $userId;

    public function __construct(string $feature,string $operate,string $table,string $content,int $userId)
    {
        $this->feature = $feature;
        $this->operate = $operate;
        $this->table = $table;
        $this->content = $content;
        $this->userId = $userId;
    }

    /**
     * Set the value of feature
     *
     * @return  self
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Set the value of operate
     *
     * @return  self
     */
    public function setOperate($operate)
    {
        $this->operate = $operate;

        return $this;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * Get the value of operate
     */
    public function getOperate()
    {
        return $this->operate;
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of content
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
