<?php

class BHS_RealShop_Block_Adminhtml_Shop extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'bhs_realshop';
        $this->_controller = 'adminhtml_shop';
        $this->_headerText = Mage::helper('adminhtml')->__('Shops');

        parent::__construct();

    }

    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller) {
            $this->setChild('grid', $this->getLayout()->createBlock($this->_blockGroup . '/' . $this->_controller . '_grid'));
        }
        return parent::_prepareLayout();
    }
}