<?php
/**
 *  @var Mage_Core_Model_Resource_Setup $installer
 */

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable("kalinich_action/post_action");

$installer->getConnection()->addColumn($tableName,'status',array(
    'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable' => false,
    'after' => 'id',
    'comment' => '1-before on;2-on;3-off'
));

$installer->endSetup();