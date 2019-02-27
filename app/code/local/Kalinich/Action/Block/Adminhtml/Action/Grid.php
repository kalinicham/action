<?php

class Kalinich_Action_Block_Adminhtml_Action_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

   public function __construct()
    {
        parent::__construct();
        $this->setId('actionBlockGrid');
        $this->setDefaultSort('is_active');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('kalinich_action/post')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('kalinich_action')->__('Active'),
            'align'     => 'left',
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('cms')->__('Disabled'),
                1 => Mage::helper('cms')->__('Enabled')
            ),
        ));
        $this->addColumn('image', array(
            'header'    => Mage::helper('cms')->__('Image'),
            'align'     => 'left',
            'index'     => 'image',
            'width'     => '70',
            'renderer' => 'Kalinich_Action_Block_Adminhtml_Action_Renderer_Image'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('cms')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('cms')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('cms')->__('Will be active'),
                1 => Mage::helper('cms')->__('Action active'),
                2 => Mage::helper('cms')->__('Action closed')
            ),
        ));
        $this->addColumn('start_datetime', array(
            'header'    => Mage::helper('cms')->__('Start date GMT'),
            'align'     => 'center',
            'index'     => 'start_datetime',
            'type'      => 'datetime',
        ));
        $this->addColumn('end_datetime', array(
            'header'    => Mage::helper('cms')->__('End date GMT'),
            'align'     => 'center',
            'index'     => 'end_datetime',
            'type'      => 'datetime'
        ));
            return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('block_id');
        $this->getMassactionBlock()->setFormFieldName('ids');

        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('kalinich_action')->__('Delete selected'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('kalinich_action')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('block_id' => $row->getId()));
    }

}
