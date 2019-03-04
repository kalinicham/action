<?php

class Kalinich_Action_Model_Cron
{

    public function actionUpDateStatus()
    {
        $actionsCollection = Mage::getModel('kalinich_action/post_action')->getCollection();
        foreach ($actionsCollection as $action) {
            var_dump($action);
        }
        return $this;
    }

}