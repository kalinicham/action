<?php

class Kalinich_Action_TestController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){

        $collection = Mage::getModel('kalinich_action/post')->getCollection()
            ->addFieldToFilter('e',array('in' => array('231','830')));


            var_dump((string)$collection->getSelect());


            foreach ($collection as $action) {
                var_dump($action->getData());
            }

     }

}