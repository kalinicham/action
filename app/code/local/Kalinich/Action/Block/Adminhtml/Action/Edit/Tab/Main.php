<?php

class Kalinich_Action_Block_Adminhtml_Action_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $model = Mage::registry('action_block');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form',
                'action' => $this->getUrl('*/*/save',array('id'=>$this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype'=> 'multipart/form-data'
            ));

            $fieldset = $form->addFieldset(
                'base_fieldset',  array(
                    'legend' => Mage::helper('cms')->__('General information Action'),
                    'class' => 'fieldset-wide'
                ));

                    $fieldset->addField('save_and_continue', 'hidden', array(
                        'name' => 'save_and_continue'
                    ));

                    if ($model->getId()) {
                        $fieldset->addField('id', 'label', array(
                            'name' => 'block_id',
                            'label'     => Mage::helper('kalinich_action')->__('Id'),
                            'title'     => Mage::helper('kalinich_action')->__('Id'),
                        ));
                    }

                    $fieldset->addField('name', 'text', array(
                        'name'      => 'name',
                        'label'     => Mage::helper('kalinich_action')->__('Action Title'),
                        'title'     => Mage::helper('kalinich_action')->__('Action Title'),
                        'required'  => true,
                    ));

                    $fieldset->addField('is_active', 'select', array(
                        'label'     => Mage::helper('kalinich_action')->__('Is Active'),
                        'title'     => Mage::helper('kalinich_action')->__('Is Active'),
                        'name'      => 'is_active',
                        'required'  => true,
                        'options'   => array(
                            '1' => Mage::helper('kalinich_action')->__('Enabled'),
                            '0' => Mage::helper('kalinich_action')->__('Disabled'),
                        ),
                    ));

                    $fieldset->addType('image','Kalinich_Action_Block_Adminhtml_Action_Renderer_ImageMain');
                    $fieldset->addField('image', 'image', array(
                        'name'      => 'image',
                        'label'     => Mage::helper('kalinich_action')->__('Image'),
                        'title'     => Mage::helper('kalinich_action')->__('Image'),
                        'required'  => false,
                        'note' => '(*.jpeg, *.jpg, *.png, *.gif)',

                    ));

                    $fieldset->addField('short_description', 'text', array(
                        'name'      => 'short_description',
                        'label'     => Mage::helper('kalinich_action')->__('Short Descriptoin'),
                        'title'     => Mage::helper('kalinich_action')->__('Short Descriptoin'),
                        'required'  => true
                    ));
                    $fieldset->addField('description', 'textarea', array(
                        'name'      => 'description',
                        'label'     => Mage::helper('kalinich_action')->__('Descriptoin'),
                        'title'     => Mage::helper('kalinich_action')->__('Descriptoin'),
                        'style'     => 'height:20em',
                        'required'  => true,
                    ));

                    $fieldset->addField('start_datetime', 'date', array(
                        'name'          => 'start_datetime',
                        'label'         => Mage::helper('kalinich_action')->__('Start Date/Time'),
                        'title'         => Mage::helper('kalinich_action')->__('Start Date/Time'),
                        'image'         => $this->getSkinUrl('images/grid-cal.gif'),
                        'format'        => 'yyyy-MM-dd HH:mm',
                        'input_format'  => 'yyyy-MM-dd HH:mm',
                        'time'          => true,
                        'required'      => true

                    ));

                    $fieldset->addField('end_datetime', 'date', array(
                        'name'          => 'end_datetime',
                        'label'         => Mage::helper('kalinich_action')->__('End Date/Time'),
                        'title'         => Mage::helper('kalinich_action')->__('End Date/Time'),
                        'image'         => $this->getSkinUrl('images/grid-cal.gif'),
                        'input_format'  => 'yyyy-MM-dd HH:mm',
                        'format'        => 'yyyy-MM-dd HH:mm',
                        'time'          => true
                    ));

                    $fieldset->addField('status', 'select', array(
                        'label'     => Mage::helper('kalinich_action')->__('Status'),
                        'title'     => Mage::helper('kalinich_action')->__('Status'),
                        'name'      => 'status',
                        'disabled'  => 'disabled',
                        'options'   => array(
                            1 => Mage::helper('cms')->__('Will be active'),
                            2 => Mage::helper('cms')->__('Action active'),
                            3 => Mage::helper('cms')->__('Action closed')
                        ),
                    ));


        $form->setValues($model->getData());
        $form->setUseContainer(false);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return $this->__('Main tab');
    }

    public function getTabTitle()
    {
        return $this->__('Title Main');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}