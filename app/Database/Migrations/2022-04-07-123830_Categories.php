<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'category_status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive']
            ],
        ]);
        $this->forge->addKey('category_id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        //
    }
}
