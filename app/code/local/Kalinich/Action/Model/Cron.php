<?php

class Kalinich_Action_Model_Cron
{

    public function actionUpDateStatus()
    {
        $date = strtotime(Mage::getModel('core/date')->gmtDate());

        $actionsCollection = Mage::getModel('kalinich_action/post')->getCollection();

        foreach ($actionsCollection as $action) {
            $status = '0'; $end = null;
            $start = strtotime($action->getStartDatetime());
            if (!is_empty_date($action->getEndDatetime())) {
                $end = strtotime($action->getEndDatetime()); }
            switch (!is_null($end)) {
                case true :
                    if ($start < $date && $date < $end) {
                        $status = '1';
                    }elseif ($end < $date) {
                        $status = '2';
                    }elseif ($date < $start) {
                        $status = '0';
                    }
                    break;
                case false :
                    if ($date < $start) {
                        $status = '0';
                    }else {
                        $status = '1';
                    }
                    break;
            }
            $action->setStatus($status);
            $action->save();
        }
    }
}