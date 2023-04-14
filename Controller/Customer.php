<?php 
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `customer` ORDER BY `first_name` DESC;";
			$customers =  Ccc::getModel('Customer_Row')->fetchAll($query);
			$grid = (new Block_Customer_Grid())->setData($customers);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$customer =  Ccc::getModel('Customer_Row');
			$customerAddress =  Ccc::getModel('Customer_Row');
			$add = (new Block_Customer_Edit())->setData(['customer' => $customer, 'customerAddress' => $customerAddress]);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($customer = Ccc::getModel('Customer_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$customerAddress = Ccc::getModel('Customer_Row');
			$customerAddress->getTable()->setTableName('customer_address');
			if (!$customerAddress->load($id)) {
				throw new Exception("Invalid Id.", 1);
			}

			$edit = (new Block_Customer_Edit())->setData(['customer' => $customer, 'customerAddress' => $customerAddress]);
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

			if (!($postData = $this->getRequest()->getPost('customer'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($customer =  Ccc::getModel('Customer_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$customer->updated_at = date("y-m-d H:i:s");
			}
			else {
				$customer =  Ccc::getModel('Customer_Row');
				$customer->created_at = date("y-m-d H:i:s");
			}

			if (!($customer = $customer->setData($postData)->save())) {
				throw new Exception("Unable to save.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('customerAddress'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				$customerAddress =  Ccc::getModel('Customer_Row');
				$customerAddress->getTable()->setTableName('customer_address');
				if (!$customerAddress->load($id)) {
					throw new Exception("Invalid Id.", 1);
				}

				$customerAddress->customer_id = $id;
			}
			else {
				$customerAddress =  Ccc::getModel('Customer_Row');
				$customerAddress->getTable()->setTableName('customer_address')->setPrimaryKey('address_id');
				$customerAddress->customer_id = $customer->customer_id;
			}

			if (!$customerAddress->setData($postData)->save()) {
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

			if (!($customer =  Ccc::getModel('Customer_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$customer->delete()) {
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