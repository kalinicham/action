<?php

class Kalinich_Action_Block_List extends Mage_Core_Block_Template {

    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('kalinich_action/post')->getCollection()
            ->addFieldToFilter('is_active','1')
            ->addFieldToFilter('status','1')
            ->setOrder('start_datetime','DESC');
        $this->setCollection($collection);
    }
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(4=>4,8=>8,16=>16,'all'=>'all'));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }
    public function getToolbarHtml()
    {
        return $this->getChildHtml('pager');
    }


}
