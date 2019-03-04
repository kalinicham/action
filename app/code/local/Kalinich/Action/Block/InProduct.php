<?php

class Kalinich_Action_Block_InProduct extends Mage_Catalog_Block_Product_Abstract {

    public function getActionId($product_id){

        $collection = Mage::getModel('kalinich_action/post_action')->getCollection()
            ->addFieldToSelect('action_id')
            ->addFieldToFilter('product_id',$product_id);
        foreach ($collection as $item) {
            $action_id[] = $item->getActionId();
        }

        return $action_id;
    }

    public function getCollection () {

    $product_id = $this->getProduct()->getId();

    $action_id = $this->getActionID($product_id);

    $collection = Mage::getModel('kalinich_action/post')->getCollection()
        ->addFieldToFilter('id',array('in' => $action_id))
        ->addFieldToFilter('status','1')
        ->addFieldToFilter('is_active','1');

    return  $collection;
    }


}