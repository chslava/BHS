<?php

class BHS_RealShop_Block_Shop_List extends Mage_Core_Block_Template
{
    protected $_shopCollection = null;

    public function getShopCollection(){

        if(!isset($this->_shopCollection)){
            $this->_shopCollection = Mage::getModel('bhs_realshop/realshop')->getCollection();
        }
        return $this->_shopCollection;
    }

    public function getShopUrl(BHS_RealShop_Model_Realshop $shop) {
        return Mage::getUrl('realshop/index/shop', array('id'=>$shop->getId()));
    }
}