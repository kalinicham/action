<?php

class Kalinich_Action_Adminhtml_ActionController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction () {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('block_id');
        $model = Mage::getModel('kalinich_action/post')->load($id);

        if ($model->getStartDatetime()) {
            $model->setStartDatetime(Mage::getModel('core/date')
                ->date(null, $model->getStartDatetime()));
        }

        if ($model->getEndDatetime()) {
            $model->setEndDatetime(Mage::getModel('core/date')
                ->date(null, $model->getEndDatetime()));
        }

        Mage::register('action_block',$model);
        $this->loadLayout();
        $this->renderLayout();
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('block_id');
        Mage::getModel('kalinich_action/post')->setId($id)->delete();
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $ids = $this->getRequest()->getParam('ids', null);
        $actionCollection = Mage::getModel('kalinich_action/post')
            ->getCollection()
            ->addFieldToFilter('id',$ids);
        foreach ($actionCollection as $action) {
            $action->delete();
        }
        $this->_redirect('*/*/');
    }

    public function categorytabAction() {
        $id = $this->getRequest()->getParam('block_id');

        $model = null;
        if ($id) {
            $model = Mage::getModel('kalinich_action/post')->load($id);
        } else {
            $model = Mage::getModel('kalinich_action/post');
        }

        Mage::register('action_block', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function categorygridAction() {
        $id = $this->getRequest()->getParam('block_id');

        $model = null;
        if ($id) {
            $model = Mage::getModel('kalinich_action/post')->load($id);
        } else {
            $model = Mage::getModel('kalinich_action/post');
        }

        Mage::register('action_block', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/kalinich_action');
    }

    public function saveAction()
    {

        $id = $this->getRequest()->getParam('id');

        $model = null;
        if ($id) {
            $model = Mage::getModel('kalinich_action/post')->load($id);
        } else {
            $model = Mage::getModel('kalinich_action/post');
        }
        /* @var $date Mage_Core_Model_Date */
        $data = $this->getRequest()->getPost();
        if (!array_key_exists('status',$data)) {
            $data['status'] = 0;
        }

        // Перетворення дати в формат GMT, create_datetime як дата модифікації
        $data['create_datetime'] = Mage::getModel('core/date')->gmtDate();
        $data['start_datetime'] = Mage::getModel('core/date')->gmtDate(null, $data['start_datetime']);
        $data['end_datetime'] = Mage::getModel('core/date')->gmtDate(null, $data['end_datetime']);

        $model->addData($data);

        $outProducts = Mage::app()->getRequest()->getParam('category_ids',null);
        $inProducts = $model->getProductColletion();
        if (!is_null($outProducts) && $outProducts == "") {
            $delProductId = $inProducts;
        }elseif (!is_null($outProducts) && !is_null($inProducts)) {
            $outProducts = explode('&',trim(trim($outProducts,'on'),'&'));
            $saveProductId = array_diff($outProducts,$inProducts);
            $delProductId = array_diff($inProducts,$outProducts);
        }elseif (!is_null($outProducts)) {
            $saveProductId  = explode('&',trim(trim($outProducts,'on'),'&'));
        }

        $backToEdit = (bool)$this->getRequest()->getParam('save_and_continue');
        $success = false;

        try {
            $model->save();

            $id = $model->id;

            if (isset($delProductId)) {
                $collection = Mage::getModel('kalinich_action/post_action')->getCollection()
                    ->addFieldToFilter('product_id',array('in' => $delProductId));
                foreach ($collection as $item) {
                    $item->delete();
                }
            }

            if (isset($saveProductId)) {
                 foreach ($saveProductId as $product) {
                             Mage::getModel('kalinich_action/post_action')
                             ->addData(array('action_id' => $id))
                             ->addData(array('product_id' => $product))
                             ->save();
                }
            }

            $this->_getSession()->addSuccess($this->__('Action was saved successfully'));
            $success = true;

        }  catch (Exception $e) {
            $this->_getSession()->addError($this->__('Error occurred while saving slider'));
            Mage::logException($e);
        }

        if (!$success || $backToEdit) {
            $this->_redirect('*/*/edit', array('id' => $model->getId()));
        } else {
            $this->_redirect('*/*/index');
        }
    }





}
