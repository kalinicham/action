<?php

class Kalinich_Action_Block_Adminhtml_Action_Renderer_ImageMain extends Varien_Data_Form_Element_Abstract{

    public function __construct($data) {
        parent::__construct($data);
        $this->setType('file');
    }

    public function getElementHtml() {
        $html = '';
        $imagePath = Mage::helper('kalinich_action')->imagePath;
        if ($this->getValue()) {
            $media = Mage::getBaseUrl('media'). $imagePath . DS;
            $html = '<a onclick="imagePreview(\''.$this->getHtmlId().'_image\'); return false;" href="'.$this->getValue().'"><img id="'.$this->getHtmlId().'_image" style="border: 1px solid #d6d6d6;" title="'.$this->getValue().'" src="'.$media.$this->getValue().'" alt="'.$this->getValue().'" width="100"></a> ';
        }
        $this->setClass('input-file');
        $html.= parent::getElementHtml();
        return $html;
    }
}