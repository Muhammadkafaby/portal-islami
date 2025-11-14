<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Admin Portal Islami',
                'email'         => 'admin@portal-islami.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'          => 'admin',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'User Demo',
                'email'         => 'user@portal-islami.com',
                'password_hash' => password_hash('user123', PASSWORD_DEFAULT),
                'role'          => 'user',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);
    }
}
