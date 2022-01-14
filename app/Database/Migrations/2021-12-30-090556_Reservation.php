<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_r'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'name'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => FALSE,
            ],
            'rtype'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => TRUE,
                'null'           => TRUE,
            ],
            'rdate'      => [
                'type'           => 'DATETIME',
                'null'           => FALSE,
            ],
            'phone'        => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => TRUE,
                'null'           => TRUE,
            ],
            'description'        => [
                'type'           => 'TEXT',
                'constraint'     => 250,
                'null'           => TRUE,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => FALSE,
            ],
        ]);
        $this->forge->addKey('id_r', true);
        $this->forge->createTable('reservation');
    }

    public function down()
    {
        $this->forge->dropTable('reservation');
    }
}
