<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `product` ORDER BY `name` DESC;";
			$products =  Ccc::getModel('Product_Row')->fetchAll($query);
			$grid = (new Block_Product_Grid())->setData($products);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$product = Ccc::getModel('Product_Row');
			$add = (new Block_Product_Edit())->setData($product);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($product =  Ccc::getModel('Product_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$edit = (new Block_Product_Edit())->setData($product);
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

			if (!($postData = $this->getRequest()->getPost('product'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($product =  Ccc::getModel('Product_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$product->updated_at = date("y-m-d H:i:s");
			}
			else {
				$product =  Ccc::getModel('Product_Row');
				$product->created_at = date("y-m-d H:i:s");
			}

			if (!$product->setData($postData)->save()) {
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

			if (!($product =  Ccc::getModel('Product_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$product->delete()) {
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