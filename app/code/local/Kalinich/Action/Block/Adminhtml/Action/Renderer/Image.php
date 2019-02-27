<?php

class Kalinich_Action_Block_Adminhtml_Action_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    protected function _getValue(Varien_Object $row)
    {
        $imagePath = Mage::helper('kalinich_action')->imagePath;
        $val = $row->getData($this->getColumn()->getIndex());
        $val = str_replace("no_selection", "", $val);
        $url = Mage::getBaseUrl('media'). $imagePath . DS . $val;
        $out = "<img src=". $url ." width='50px'/>";
        return $out;
    }
}