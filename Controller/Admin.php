<?php
class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `admin` ORDER BY `name` DESC;";
			$admins = Ccc::getModel('Admin_Row')->fetchAll($query);
			$grid = (new Block_Admin_Grid())->setData($admins);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$admin = Ccc::getModel('Admin_Row');
			$add = (new Block_Admin_Edit())->setData($admin);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($admin = Ccc::getModel('Admin_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$edit = (new Block_Admin_Edit())->setData($admin);
			$this->getLayout()->getChild('content')->addChild('edit', $edit);
			$this->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('admin'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($admin = Ccc::getModel('Admin_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$admin->updated_at = date("y-m-d H:i:s");
			} else {
				$admin = Ccc::getModel('Admin_Row');
				$admin->created_at = date("y-m-d H:i:s");
			}

			if (!$admin->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$this->getMessage()->addMessage('Data saved successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}

	public function deleteAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($admin = Ccc::getModel('Admin_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$admin->delete()) {
				throw new Exception("Unable to delete.", 1);
			}

			$this->getMessage()->addMessage('Data deleted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}

}
?>