<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status'      => [
                'type'    => 'ENUM',
                'constraint' => ['pending', 'completed', 'cancelled'],
                'default' => 'pending',
            ],
            'total'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
    'type' => 'TIMESTAMP',
    'null' => false,
],
'updated_at' => [
    'type' => 'TIMESTAMP',
    'null' => false,
],

        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }
    

    public function down()
    {
        // Drop tabel jika migrasi di-revert
        $this->forge->dropTable('orders');
    }
}
