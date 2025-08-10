<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now()->toDateTimeString();
        $this->db->table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'is_admin' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
