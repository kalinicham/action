<?php

class Kalinich_Action_TestController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){

        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('visibility')
            ->addFieldToFilter('entity_id',array('in' => array('231','830')));


            var_dump((string)$collection->getSelect());


            foreach ($collection as $action) {
                var_dump($action->getData());
            }

     }

}