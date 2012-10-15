<?php
class Model
{
    protected $_attributes = array();
    protected $_errors = array();
	
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
            throw new Exception("Attribute '$name' doesn\'t exist in the model '".get_class($this)."'");
    }
	
	public function getAttributes()
    {
        return $this->_attributes;
    }

    public function attributeNames()
    {
        return array();
    }
    
    public function validate()
    {
        return false;
    }
    
	public function unsetAttributes()
	{
		foreach ($this->_attributes as $name => $value)
		{
			$this->_attributes[$name] = null;
		}
	}	
	
    public function getError($attributeName)
    {
        $error = isset($this->_errors[$attributeName][0])? $this->_errors[$attributeName][0]: '';
        return $error;
    }
	
	public function hasErrors($attribute = null)
	{
		if (null === $attribute)
			return count($this->_errors);
		else
			return count($this->_errors[$attribute]);
	}
	
	public function getErrors($attribute = null)
	{
		if (null === $attribute)
			return $this->_errors;
		else
			return $this->getError($attribute);
	}
	
	public function addError($attribute, $errorMessage)
	{
		$this->_errors[$attribute][] = $errorMessage;
	}
}