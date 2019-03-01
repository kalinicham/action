<?php

$collection = Mage::getModel('kalinich_action/post')->getCollection();
foreach ($collection as $action) {
       for ($i = 370;$i < 380;$i++) {
           $product = Mage::getModel('kalinich_action/post_action');
           $product->setActionId($action->getId());
           $product->setProductId($i);
           $product->save();
       }
}