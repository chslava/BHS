<?php

class BHS_RealShop_Adminhtml_RealshopController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('bhs_realshop/shop');
//        $this->_addContent($this->getLayout()->createBlock('bhs_realshop/shop_items'));
        $this->renderLayout();
    }

}