<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaskCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'task_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('task_id', 'tasks', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('task_customer');
    }

    public function down()
    {
        $this->forge->dropTable('task_customer');
    }
}
