<?php

class Kalinich_Action_Block_List extends Mage_Catalog_Block_Product_List {

        public function getDefaultActionCollection(){
            $collection = Mage ::getModel('kalinich_action/post')->getCollection();
        return $collection;
        }
}
