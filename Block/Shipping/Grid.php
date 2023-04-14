<?php
class Block_Shipping_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('shipping/grid.phtml');
	}

	public function getShippings()
	{
		return $this->shippings;
	}
}
?>