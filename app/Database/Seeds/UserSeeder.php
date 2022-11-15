<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_user' => 'Imron Rusadi',
                'email'     => 'imron.rusadi37@gmail.com',
                'password'  => password_hash('12345', PASSWORD_BCRYPT),
                'username'  => 'imron',
                'level'     => 'admin',
                'id_dept'   => '2'
            ],
            [
                'nama_user' => 'Marlina Ratis',
                'email'     => 'marlinaratis@gmail.com',
                'password'  => password_hash('12345', PASSWORD_BCRYPT),
                'username'  => 'ratis',
                'level'     => 'user',
                'id_dept'   => '4'
            ]
        ];

        $this->db->table('tbl_user')->insertBatch($data);
    }
}
