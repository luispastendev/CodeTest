<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'        => [
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
            'id_ctype'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => TRUE,
                'null'           => TRUE,
            ],
            'bday'      => [
                'type'           => 'DATETIME',
                'null'           => FALSE,
            ],
            'phone'        => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => TRUE,
                'null'           => TRUE,
            ],

            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => FALSE,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('contact');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('contact');
    }
}
