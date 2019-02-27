<?php

class Kalinich_Action_Model_Resource_Post_Action extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('kalinich_action/post_action_product','id');
    }

}