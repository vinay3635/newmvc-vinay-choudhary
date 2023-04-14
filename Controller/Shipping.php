<?php
class Controller_Shipping extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `shipping_method` ORDER BY `name` DESC;";
			$shippings =  Ccc::getModel('Shipping_Row')->fetchAll($query);
			$grid = (new Block_Shipping_Grid())->setData(['shippings' => $shippings]);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$shipping =  Ccc::getModel('Shipping_Row');
			$add = (new Block_Shipping_Edit())->setData(['shipping' => $shipping]);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($shipping =  Ccc::getModel('Shipping_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$edit = (new Block_Shipping_Edit())->setData(['shipping' => $shipping]);
			$this->getLayout()->getChild('content')->addChild('edit', $edit);
			$this->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('shipping'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($shipping =  Ccc::getModel('Shipping_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$shipping->updated_at = date("y-m-d H:i:s");
			}
			else {
				$shipping =  Ccc::getModel('Shipping_Row');
				$shipping->created_at = date("y-m-d H:i:s");
			}
			
			if (!$shipping->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$this->getMessage()->addMessage('Data saved successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		
		$this->redirect('grid', null, [], true);
	}

	public function deleteAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($shipping =  Ccc::getModel('Shipping_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$shipping->delete()) {
				throw new Exception("Unable to delete.", 1);
			}

			$this->getMessage()->addMessage('Data deleted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}
	
}
?>