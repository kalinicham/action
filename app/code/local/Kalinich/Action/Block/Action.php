<?php

class Kalinich_Action_Block_Action extends Mage_Catalog_Block_Product_Abstract {

        public function getIdAction(){
            $id = Mage::registry('action_view')->getId();
            return $id;
        }

        public function getAction(){
            $action = Mage::registry('action_view');
            return $action;
        }

        public function getIdProductCollection() {
            $id = $this->getIdAction();
            $collection = Mage::getModel('kalinich_action/post_action')
                ->getCollection()->addFieldToFilted('action_id',$id);
            foreach ($collection as $item) {
                $idProductCollection[] = $item->getProductId();
            }
            return $idProductCollection;
        }

        public function getCollectionProducts() {
            $products = $this->getIdProductCollection();
            $collection = Mage::getModel();
        }

}
