<?php
/* @var $installer Mage_Catalog_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

/**
 * Create table 'bhs_realshop/bhs_realshop'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('bhs_realshop/bhs_realshop'))
    ->addColumn('shop_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'ID')
    ->addColumn('shop_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
    ), 'Shop Name')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => true,
    ), 'Shop Image')
    ->addColumn('short_description', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ), 'Short Description')
    ->addColumn('long_description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => true,
    ), 'Long Description')
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ), 'Address')
    ->addIndex($installer->getIdxName('bhs_realshop/bhs_realshop', array('shop_name')), array('shop_name'))
    ->setComment('BHS Real Shop Backend Table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
