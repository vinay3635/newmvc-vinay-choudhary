<?php
class Block_Customer_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/grid.phtml');
	}

	public function getCustomers()
	{
		return $this->getData();
	}
}
?>