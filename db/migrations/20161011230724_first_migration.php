<?php
// @codingStandardsIgnoreFile

use Phinx\Migration\AbstractMigration;

class FirstMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $people = $this->table('people');
        $people->addColumn('first_name', 'string', array('limit' => 255))
               ->addColumn('middle_name', 'string', array(
                   'limit'=> 255,
                   'default' => '',
               ))
               ->addColumn('last_name', 'string', array('limit' => 255))
               ->addColumn('created_at', 'datetime', array(
                   'default' => 'CURRENT_TIMESTAMP',
               ))
               ->addColumn('updated_at', 'datetime', array(
                   'default' => 'CURRENT_TIMESTAMP',
                   'update' => 'CURRENT_TIMESTAMP',
               ))
               ->create();

        $addresses = $this->table('addresses');
        $addresses->addColumn('address', 'string', array('limit' => 255))
                  ->addColumn('city', 'string', array('limit' => 255))
                  ->addColumn('state', 'string', array('limit' => 255))
                  ->addColumn('zip', 'string', array('limit' => 255))
                  ->addColumn('created_at', 'datetime', array(
                      'default' => 'CURRENT_TIMESTAMP',
                  ))
                  ->addColumn('updated_at', 'datetime', array(
                      'default' => 'CURRENT_TIMESTAMP',
                      'update' => 'CURRENT_TIMESTAMP',
                  ))
                  ->create();

        $peopleAddresses = $this->table('people_addresses');
        $peopleAddresses->addColumn('primary', 'boolean', array(
                            'default' => 'FALSE'
                        ))
                        ->addColumn('people_id', 'integer')
                        ->addColumn('addresses_id', 'integer')
                        ->addForeignKey('people_id', 'people', 'id')
                        ->addForeignKey('addresses_id', 'addresses', 'id')
                        ->create();
    }
}
