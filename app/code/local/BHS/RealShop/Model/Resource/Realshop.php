<?php

class BHS_RealShop_Model_Resource_Realshop extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('bhs_realshop/bhs_realshop', 'shop_id');
    }
}
