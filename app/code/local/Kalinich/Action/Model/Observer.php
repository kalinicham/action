<?php

class Kalinich_Action_Model_Observer {
    /**
     * @param $observer Varien_Event_Observer
     */
        public function addItemMenu ($observer)
        {
            $menu = $observer->getData('menu');
            $tree = $menu->getTree();
            $data = new Varien_Data_Tree_Node(array(
                'name'   => 'Kalinich_Action',
                'id'     => 'kalinich_action_menu',
                'url'    => Mage::getUrl('kalinich_action'), ), 'id', $tree, $menu);
            $menu->addChild($data);
            return $this;
        }

}