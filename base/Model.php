<?php
require_once('base/Db.php');
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

    public function attributeNames()
    {
        return array();
    }
    
    public function tableName()
    {
        return '';
    }
    
    public function findAll($condition = '', $order = '')
    {
        $resultArray = Db::getInstance()->select($this->tableName(), '*', $condition, $order);
        $result = array();
        $className = get_class($this);            
        foreach ($resultArray as $row)
        {
            $newObject = new $className;
            $newObject->setAttributes($row);
            $result[] = $newObject;
        }
        return $result;
    }
    
    public function validate()
    {
        return false;
    }

    public function save($validate = true)
    {
        if ($validate && !$this->validate())
            return false;
        else
        {
            return Db::getInstance()->insert($this->tableName(), $this->_attributes);
        }        
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
}