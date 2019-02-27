<?php

class Kalinich_Action_Block_Adminhtml_Action_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('action_tabs');
        $this->setDestElementId('edit_form');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('category', array(
            'label'     => $this->__('Products'),
            'title'     => $this->__('Products'),
            'url'       => $this->getUrl('*/*/categorytab', array('_current' => true)),
            'class'     => 'ajax'
        ));
        return parent::_beforeToHtml();
    }
}