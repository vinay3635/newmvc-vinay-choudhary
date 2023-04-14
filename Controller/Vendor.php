<?php 
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `vendor` ORDER BY `first_name` DESC;";
			$vendors =  Ccc::getModel('Vendor_Row')->fetchAll($query);
			$grid = (new Block_Vendor_Grid())->setData(['vendors' => $vendors]);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$vendor =  Ccc::getModel('Vendor_Row');
			$vendorAddress =  Ccc::getModel('Vendor_Row');
			$add = (new Block_Vendor_Edit())->setData(['vendor' => $vendor, 'vendorAddress' => $vendorAddress]);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($vendor =  Ccc::getModel('Vendor_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$vendorAddress =  Ccc::getModel('Vendor_Row');
			$vendorAddress->getTable()->setTableName('vendor_address');
			if (!$vendorAddress->load($id)) {
				throw new Exception("Invalid Id.", 1);
			}

			$edit = (new Block_Vendor_Edit())->setData(['vendor' => $vendor, 'vendorAddress' => $vendorAddress]);
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

			if (!($postData = $this->getRequest()->getPost('vendor'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($vendor =  Ccc::getModel('Vendor_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$vendor->updated_at = date("y-m-d H:i:s");
			}
			else {
				$vendor =  Ccc::getModel('Vendor_Row');
				$vendor->created_at = date("y-m-d H:i:s");
			}

			if (!($vendor = $vendor->setData($postData)->save())) {
				throw new Exception("Unable to save.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('vendorAddress'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				$vendorAddress =  Ccc::getModel('Vendor_Row');
				$vendorAddress->getTable()->setTableName('vendor_address');
				if (!$vendorAddress->load($id)) {
					throw new Exception("Invalid Id.", 1);
				}

				$vendorAddress->vendor_id = $id;
			}
			else {
				$vendorAddress =  Ccc::getModel('Vendor_Row');
				$vendorAddress->getTable()->setTableName('vendor_address')->setPrimaryKey('address_id');
				$vendorAddress->vendor_id = $vendor->vendor_id;
			}

			if (!$vendorAddress->setData($postData)->save()) {
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

			if (!($vendor =  Ccc::getModel('Vendor_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$vendor->delete()) {
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