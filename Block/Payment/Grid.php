<?php
class Block_Payment_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment/grid.phtml');
	}

	public function getPayments()
	{
		return $this->getData();
	}
}
?>