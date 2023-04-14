<?php

class Block_Html_Content extends Block_Core_Abstract
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->setTemplate('core/layout/3columns.phtml');
	}
}

?>