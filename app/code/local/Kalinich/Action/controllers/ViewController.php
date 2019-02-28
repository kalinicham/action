<?php

class Kalinich_Action_ViewController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $this->loadLayout();
            $this->renderLayout();
            var_dump(Mage::helper('core')->getLayout()->getUpdate()->getHandles());
        }else {
            $this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
            $this->getResponse()->setHeader('Status','404 File not found');
            $this->_forward('defaultNoRoute');
        }
     }

}