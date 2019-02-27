<?php

/**
 *  @var Mage_Core_Model_Resource_Setup $installer
 */

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('kalinich_action/post_action_product');
$tableAction = $installer->getTable('kalinich_action/post_action');
$tableProduct = $installer->getTable('catalog/product');


$table = $installer->getConnection()->newTable($tableName)
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'identity'  =>  true,
        'unsigned'  =>  true,
        'nullable'  =>  false,
        'primary'   =>  true
    ),'ID of row')
    ->addColumn('action_id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'nullable'  =>  true,
    ),'id Action')
    ->addColumn('product_id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'nullable'  =>  true,
    ),'id Product')
    ->addForeignKey('FK_AP_AC','action_id',$tableAction,'id',Varien_Db_Ddl_Table::ACTION_CASCADE,Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey('FK_AP_CP','product_id',$tableProduct,'entity_id',Varien_Db_Ddl_Table::ACTION_CASCADE,Varien_Db_Ddl_Table::ACTION_CASCADE);

    $table->addIndex($indexName, array('id'), array(
        'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    )
);

$installer->getConnection()->createTable($table);

$installer->endSetup();