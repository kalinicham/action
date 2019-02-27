<?php

class Kalinich_Action_Model_Resource_Post_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        parent::_construct();
        $this->_init('kalinich_action/post','id');
    }

}