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
                ->getCollection()->addFieldToFilter('action_id',$id);
            foreach ($collection as $item) {
                $idProductCollection[] = $item->getProductId();
            }
            return $idProductCollection;
        }

        public function getCollectionProducts() {
            $productsId = $this->getIdProductCollection();
            $storeId = Mage::app()->getStore()->getId();
            $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addStoreFilter($storeId)
                ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
                ->addFieldToFilter('visibility', array('in' => array(
                    Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG,
                    Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_SEARCH,
                    Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)))
                ->addFieldToFilter('entity_id',array('in' => $productsId));
            return $collection;
        }

}
