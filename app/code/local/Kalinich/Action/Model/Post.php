<?php

class Kalinich_Action_Model_Post extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('kalinich_action/post');
    }

    protected function _beforeSave()
    {
        if ($this->getData('image/delete')) {
            $this->unsImage();
        }
        if ($_FILES['image']['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(true);

                $this->setImage($uploader);
            } catch (Exception $e) {
                // it means that we do not have files for uploading
            }
        } else  {
//            $this->setData('image', $this->getData('image')['value']);
        }

        return parent::_beforeSave();
    }

    public function getImagePath()
    {
        return Mage::getBaseDir('media') . DS . Mage::helper('kalinich_action')->imagePath . DS;
    }

    public function setImage($image)
    {
        if ($image instanceof Varien_File_Uploader) {
            $image->save($this->getImagePath());
            $image = $image->getUploadedFileName();
        }
        $this->setData('image', $image);
        return $this;
    }

    public function getImage()
    {
        if ($image = $this->getData('image')) {
            return Mage::getBaseUrl('media') . Mage::helper('kalinich_action')->imagePath . DS . $image;
        } else {
            return '';
        }
    }

    protected function prepareImageForDelete()
    {
        $image = $this->getData('image');
        return str_replace(Mage::getBaseUrl('media'), Mage::getBaseDir('media') . DS, $image['value']);
    }

    public function unsImage()
    {
        $image = $this->getData('image');
        if (is_array($image)) {
            $image = $this->prepareImageForDelete();
        } else {
            $image = $this->getImagePath() . $image;
        }

        if (file_exists($image)) {
            unlink($image);
        }
        $this->setData('image', '');
        return $this;
    }

    public function getProductColletion() {

        $collection = Mage::getModel('kalinich_action/post_action')->getCollection()
            ->addFieldToSelect('product_id')
            ->addFieldToFilter('action_id',$this->getId());
        foreach ($collection as $value) {
            $product[] = $value->getProductId();
        }
        return $product;
    }
}