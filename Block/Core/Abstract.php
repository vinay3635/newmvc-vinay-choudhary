<?php

class Block_Core_Abstract extends Model_Core_View
{
	protected $children = [];

	public function __construct()
	{
		// parent::__construct();
	}
	
	public function setchildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($key, $value)
	{
		$this->children[$key] = $value;
		return $this;
	}

	public function removeChild($key)
	{
		if (array_key_exists($key, $this->children)) {
		unset($this->children[$key]);
		}
		return $this;
	}

	public function getChild($key)
	{
		if (array_key_exists($key, $this->children)) {
			return $this->children[$key];
		}
		return null;
	}


}

?>