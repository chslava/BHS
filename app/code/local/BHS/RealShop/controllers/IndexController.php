<?php

class BHS_RealShop_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
        $this->loadLayout();
        $this->renderLayout();
    }

    public function shopAction() {
        $shopId = $this->getRequest()->getParam('id');
        if ($shopId) {
            $shop = Mage::getModel('bhs_realshop/realshop')->load($shopId);
            Mage::register('current_shop',$shop);
        }
        $this->loadLayout();
        $this->renderLayout();
    }
}