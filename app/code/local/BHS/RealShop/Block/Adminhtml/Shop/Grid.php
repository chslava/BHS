<?php

class BHS_RealShop_Block_Adminhtml_Shop_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('shop_items');
        $this->setDefaultSort('shop_id');
    }


    protected function _prepareCollection()
    {

        $collection = Mage::getModel('bhs_realshop/realshop')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }


    protected function _prepareColumns()
    {
        $this->addColumn('shop_id', array(
            'header' => Mage::helper('bhs_realshop')->__('ID'),
            'align' => 'left',
            'sortable' => true,
            'width' => '10',
            'index' => 'shop_id'
        ));

        $this->addColumn('shop_name', array(
            'header' => Mage::helper('bhs_realshop')->__('Name'),
            'align' => 'left',
            'sortable' => true,
            'width' => '240',
            'index' => 'shop_name',
            'type'  => 'text'
        ));

        $this->addColumn('short_description', array(
            'header' => Mage::helper('bhs_realshop')->__('Short Description'),
            'sortable' => false,
            'align' => 'left',
            'index' => 'short_description',
            'type'  => 'text'
        ));

        $this->addColumn('address', array(
            'header' => Mage::helper('bhs_realshop')->__('Address'),
            'align' => 'left',
            'sortable' => false,
            'width' => '360',
            'index' => 'address',
            'type'  => 'text'
        ));

        $this->addColumn('image', array(
            'header' => Mage::helper('bhs_realshop')->__('Picture'),
            'align' => 'right',
            'sortable' => false,
            'width' => '60',
            'index' => 'image',
            'renderer'  => 'BHS_RealShop_Block_Adminhtml_Renderer_Image'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}