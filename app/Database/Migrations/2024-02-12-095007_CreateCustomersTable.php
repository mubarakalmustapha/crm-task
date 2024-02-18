<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'primary_email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'zipcode' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
