<?php

namespace App\Dto;

class InputRoleDto
{
    protected $name;
    protected $key;
    protected $status;
    protected $weight;
    protected $remark;

    public function __construct($name, $key, $status, $weight, $remark = "")
    {
        $this->name = $name;
        $this->key = $key;
        $this->status = $status;
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the value of remark
     */
    public function getRemark()
    {
        return $this->remark;
    }
}
