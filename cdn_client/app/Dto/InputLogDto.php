<?php

namespace App\Dto;

class InputLogDto
{
    protected $feature;
    protected $operate;
    protected $table;
    protected $content;

    public function __construct($feature, $operate, $table, $content)
    {
        $this->feature = $feature;
        $this->operate = $operate;
        $this->table = $table;
        $this->content = $content;
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
}
