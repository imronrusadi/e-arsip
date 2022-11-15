<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'username' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'level' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'id_dept' => [
                'type' => 'int',
                'constraint' => 5,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('id_dept', 'tbl_dept', 'id_dept');
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropForeignKey('id_dept', 'tbl_dept', 'id_dept');
        $this->forge->dropTable('tbl_user');
    }
}
