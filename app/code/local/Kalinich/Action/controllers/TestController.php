<?php

class Kalinich_Action_TestController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){

            $collection = Mage::getModel('kalinich_action/post_action')->getCollection();
//                ->addFieldToFilter ('entity_id','250');

            var_dump((string)$collection->getSelect());


            foreach ($collection as $action) {
                var_dump($action->getData());
            }

     }

}