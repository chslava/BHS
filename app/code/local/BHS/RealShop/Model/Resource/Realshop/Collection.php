<?php
class BHS_RealShop_Model_Resource_Realshop_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('bhs_realshop/realshop');
    }
}