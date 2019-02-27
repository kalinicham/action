<?php

class Kalinich_Action_Block_Adminhtml_Action_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'kalinich_action';
    protected $_controller = 'adminhtml_action';
    protected $_objectId = 'block_id';

    public function __construct()
    {

//        $this->_objectId = 'block_id';
//        $this->_controller = 'adminhtml_siteblocks';
//        $this->_blockGroup = 'siteblocks';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('kalinich_action')->__('Save Action'));

        $this->_updateButton('delete', 'label', Mage::helper('kalinich_action')->__('Delete Action'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => "$('save_and_continue').value = 1; editForm.submit();",
            'class'     => 'save',
        ), -100);
    }

    public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save', array('id' => $this->_getModel()->getId()));
    }

    protected function _getModel()
    {
        $model = Mage::registry('action_block');
        return $model;
    }

}
