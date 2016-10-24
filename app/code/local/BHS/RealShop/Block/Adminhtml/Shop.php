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
}