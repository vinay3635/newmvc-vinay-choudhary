<?php
class Block_Salesman_Price_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/price/grid.phtml');
	}

	public function getSalesmen()
	{
		return $this->salesmen;
	}

	public function getSalesmenPrice()
	{
		return $this->salesmenPrice;
	}
}
?>