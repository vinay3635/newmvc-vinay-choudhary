<?php
class Block_Salesman_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/grid.phtml');
	}

	public function getSalesmen()
	{
		return $this->salesmen;
	}
}
?>