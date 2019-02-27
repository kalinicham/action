<?php

$collection = Mage::getModel('kalinich_action/post')->getCollection();

foreach ($collection as $action) {
    $action->setStatus('0');
    $action->save();
}