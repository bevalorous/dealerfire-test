<?php

class Model
{
    protected $_attributes = array();
    
    public function __construct()
    {
        $this->_attributes = array_fill_keys($this->attributeNames(), null);        
    }

    public function setAttribute($name, $value)
    {
        if (array_key_exists($name, $this->_attributes))
            $this->_attributes[$name] = $value;
    }

    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $value)
        {
            $this->setAttribute($name, $value);
        }
    }

    public function getAttribute($name)
    {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];
        else
            throw new Exception("Attribute $name doesn\'t exist in the model {__CLASS__}");
    }

    public function attributeNames()
    {
        return array();
    }
}