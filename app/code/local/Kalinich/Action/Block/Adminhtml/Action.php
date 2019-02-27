<?php

class Kalinich_Action_Block_Adminhtml_Action extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_action';
        $this->_blockGroup = 'kalinich_action';
        $this->_headerText = Mage::helper('kalinich_action')->__('Kalinich Action');
        $this->_addButtonLabel = Mage::helper('kalinich_action')->__('Add New Action');
        parent::__construct();
    }

}
