<?php
class Block_Category_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/grid.phtml');
	}

	public function getCategories()
	{
		return $this->getData();
	}
}
?>