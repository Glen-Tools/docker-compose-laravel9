<?php

namespace App\Dto;

class InputMenuDto
{
    protected $name;
    protected $key;
    protected $url;
    protected $feature;
    protected $status;
    protected $parent;
    protected $weight;
    protected $remark;

    public function __construct($name, $key, $url, $feature, $status, $parent, $weight, $remark = "")
    {
        $this->name = $name;
        $this->key = $key;
        $this->url = $url;
        $this->feature = $feature;
        $this->status = $status;
        $this->parent = $parent;
        $this->weight = $weight;
        $this->remark = $remark;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
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
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set the value of parent
     *
     * @return  self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Set the value of remark
     *
     * @return  self
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get the value of remark
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the value of parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }
}
