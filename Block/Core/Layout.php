<?php
class Block_Core_Layout extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/layout/1column.phtml');
		$this->prepareChildren();
	}

	public function prepareChildren()
	{
		$header = new Block_Html_Header();
		$this->addChild('header', $header);
		$message = new Block_Html_Message();
		$this->addChild('message', $message);
		$left = new Block_Html_Left();
		$this->addChild('left', $left);
		$content = new Block_Html_Content();
		$this->addChild('content', $content);
		$right = new Block_Html_Right();
		$this->addChild('right', $right);
		$footer = new Block_Html_Footer();
		$this->addChild('footer', $footer);
	}

	public function createBlock($blockName)
	{
		$block = 'Block_'.$blockName;
		return new $block();
	}
}
?>