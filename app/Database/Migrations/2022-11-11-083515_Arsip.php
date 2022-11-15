<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Arsip extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_arsip' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'id_kategori' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'no_arsip' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'id_dept' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_arsip', true);
        $this->forge->addForeignKey('id_kategori', 'tbl_kategori', 'id_kategori');
        $this->forge->addForeignKey('id_dept', 'tbl_dept', 'id_dept');
        $this->forge->addForeignKey('id_user', 'tbl_user', 'id_user');
        $this->forge->createTable('tbl_arsip');
    }

    public function down()
    {
        $this->forge->dropForeignKey('id_kategori', 'tbl_kategori', 'id_kategori');
        $this->forge->dropForeignKey('id_dept', 'tbl_dept', 'id_dept');
        $this->forge->dropForeignKey('id_user', 'tbl_user', 'id_user');
        $this->forge->dropTable('tbl_arsip');
    }
}
