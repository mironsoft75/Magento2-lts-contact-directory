<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 12:11 PM
 */
namespace Lts\Contact\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'A_Lts_Contacts'
         */
        if (!$installer->tableExists('A_Lts_Contacts')) {
            $tableName = $installer->getTable('A_Lts_Contacts');
            $tableComment = 'Lozingle Employee Contact Details';
            $indexes = array(
                // No index for this table
            );

            $foreignKeys = array(
                // No foreign keys for this table
            );
            $table = $installer->getConnection()->newTable($tableName);

            // Columns creation

            $table->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Employee Id'
            );
            $table->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Employee name'
            );
            $table->addColumn(
                'phoneNo',
                Table::TYPE_TEXT,
                20,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Employee Phone No'
            );
            $table->addColumn(
                'description',
                Table::TYPE_TEXT,
                2048,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Employee Description'
            );
            $table->addColumn(
                'join_date',
                Table::TYPE_TEXT,
                20,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Employee Joining Date'
            );
            $table->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Employee Image'
            );

            $table->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                1,
                [
                    'nullable' => false,
                    'default' => '0'
                ],
                'Employee status'
            );
            $table->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => ''
                ],
                'Created date'
            );
            // Indexes creation
            foreach ($indexes AS $index) {
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }

            // Foreign keys creation
            foreach ($foreignKeys AS $column => $foreignKey) {
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }

            // Table comment
            $table->setComment($tableComment);

            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);
        }
        // End Setup
        $installer->endSetup();
    }

}
