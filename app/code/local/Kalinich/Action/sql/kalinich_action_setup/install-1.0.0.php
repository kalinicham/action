<?php
/**
 * @var Mage_Core_Model_Resource_Setup $installer
 */
$installer = $this;
$installer->startSetup();
$tableName = $installer->getTable('kalinich_action/post_action');

$table = $installer->getConnection()->newTable($tableName)
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'identity'  =>  true,
        'unsigned'  =>  true,
        'nullable'  =>  false,
        'primary'   =>  true
    ),'ID of row')
    ->addColumn('is_active',Varien_Db_Ddl_Table::TYPE_BOOLEAN,null,array(
        'nullable'  =>  false,
        'default'   =>  false
    ),'Enabled/Disable Action')
    ->addColumn('name',Varien_Db_Ddl_Table::TYPE_TEXT,null,array(
        'nullable'  =>  false,
    ),'Name Action')
    ->addColumn('description',Varien_Db_Ddl_Table::TYPE_TEXT,null,array(
        'nullable'  =>  false,
    ),'Description Action')
    ->addColumn('short_description',Varien_Db_Ddl_Table::TYPE_TEXT,null,array(
        'nullable'  =>  false,
    ),'Short description Action')
    ->addColumn('image',Varien_Db_Ddl_Table::TYPE_VARCHAR,255,array(
        'nullable'  =>  false,
    ),'Image')
    ->addColumn('create_datetime',Varien_Db_Ddl_Table::TYPE_DATETIME,null,array(
        'nullable'  =>  false,
    ),'Create date_time Action')
    ->addColumn('start_datetime',Varien_Db_Ddl_Table::TYPE_DATETIME,null,array(
        'nullable'  =>  false,
    ),'Start data_time Action')
    ->addColumn('end_datetime',Varien_Db_Ddl_Table::TYPE_DATETIME,null,array(
        'nullable'  =>  true,
        'default'   =>  null
    ),'End data_time Action, possible Null');

$table->addIndex(
    $indexName,
    array('id'),
    array(
        'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    )
);


$installer->getConnection()->createTable($table);

$installer->endSetup();