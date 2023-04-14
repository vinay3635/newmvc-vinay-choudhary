<?php 
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `salesman` ORDER BY `first_name` DESC;";
			$salesmen =  Ccc::getModel('Salesman_Row')->fetchAll($query);
			$grid = (new Block_Salesman_Grid())->setData(['salesmen' => $salesmen]);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$salesman =  Ccc::getModel('Salesman_Row');
			$salesmanAddress =  Ccc::getModel('Salesman_Row');
			$add = (new Block_Salesman_Edit())->setData(['salesman' => $salesman, 'salesmanAddress' => $salesmanAddress]);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($salesman =  Ccc::getModel('Salesman_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$salesmanAddress =  Ccc::getModel('Salesman_Row');
			$salesmanAddress->getTable()->setTableName('salesman_address');
			if (!$salesmanAddress->load($id)) {
				throw new Exception("Invalid Id.", 1);
			}

			$edit = (new Block_Salesman_Edit())->setData(['salesman' => $salesman, 'salesmanAddress' => $salesmanAddress]);
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

			if (!($postData = $this->getRequest()->getPost('salesman'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($salesman =  Ccc::getModel('Salesman_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$salesman->updated_at = date("y-m-d H:i:s");
			}
			else {
				$salesman =  Ccc::getModel('Salesman_Row');
				$salesman->created_at = date("y-m-d H:i:s");
			}

			if (!($salesman = $salesman->setData($postData)->save())) {
				throw new Exception("Unable to save.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('salesmanAddress'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				$salesmanAddress =  Ccc::getModel('Salesman_Row');
				$salesmanAddress->getTable()->setTableName('salesman_address');
				if (!$salesmanAddress->load($id)) {
					throw new Exception("Invalid Id.", 1);
				}

				$salesmanAddress->salesman_id = $id;
			}
			else {
				$salesmanAddress =  Ccc::getModel('Salesman_Row');
				$salesmanAddress->getTable()->setTableName('salesman_address')->setPrimaryKey('address_id');
				$salesmanAddress->salesman_id = $salesman->salesman_id;
			}

			if (!$salesmanAddress->setData($postData)->save()) {
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

			if (!($salesman =  Ccc::getModel('Salesman_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$salesman->delete()) {
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