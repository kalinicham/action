<?php

$collection = Mage::getModel('kalinich_action/post')->getCollection();
foreach ($collection as $action) {
       for ($i = 250;$i < 260;$i++) {
           $product = Mage::getModel('kalinich_action/post_action');
           $product->setActionId($action->getId());
           $product->setProductId($i);
           $product->save();
       }
}