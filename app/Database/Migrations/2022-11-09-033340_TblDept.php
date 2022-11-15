<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblDept extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dept' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_dep' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_dept', true);
        $this->forge->createTable('tbl_dept');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_dept');
    }
}
