<?php
class Controller
{
    public function render($view, $data)
    {
        foreach ($data as $name => $value)
        {
            $$name = $value;
        }        
        $className = get_class($this);
        require('protected/views/'.substr($className, 0, strripos($className, 'controller')).'/'.$view.'.php');
    }
	
	public function renderPartial($view, $data)
    {
        foreach ($data as $name => $value)
        {
            $$name = $value;
        }        
        $className = get_class($this);
        require('protected/views/'.substr($className, 0, strripos($className, 'controller')).'/'.$view.'.php');
    }
}