<?php
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `category` WHERE `parent_id` > 0 ORDER BY `path` ASC;";
			$categories = Ccc::getModel('Category_Row')->fetchAll($query);
			$grid = (new Block_Category_Grid())->setData($categories);
			$this->getLayout()->getChild('content')->addChild('grid', $grid);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$category = Ccc::getModel('Category_Row');
			$parentCategories = Ccc::getModel('Category_Row')->getParentCategories();
			$add = (new Block_Category_Edit())->setData(['category' => $category, 'parentCategories' => $parentCategories]);
			$this->getLayout()->getChild('content')->addChild('add', $add);
			$this->render();
		} catch (Exception $e) {

		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($category = Ccc::getModel('Category_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
				}
			}

			$parentCategories = Ccc::getModel('Category_Row')->getParentCategories();
			foreach ($parentCategories as $categoryId => $path) {
				if (str_contains($path, $category->path)) {
					unset($parentCategories[$categoryId]);
				}
			}

			$edit = (new Block_Category_Edit())->setData(['category' => $category, 'parentCategories' => $parentCategories]);
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

			if (!($postData = $this->getRequest()->getPost('category'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($category = Ccc::getModel('Category_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$category->updated_at = date("y-m-d H:i:s");
			} else {
				$category = Ccc::getModel('Category_Row');
				$category->created_at = date("y-m-d H:i:s");
			}

			if (!$category->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$category->updatePath();
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

			if (!($category = Ccc::getModel('Category_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			$query = "DELETE FROM `category` WHERE `path` LIKE '{$category->path}/%' OR `path` = '{$category->path}'";
			if (!$category->getTable()->getAdapter()->delete($query)) {
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