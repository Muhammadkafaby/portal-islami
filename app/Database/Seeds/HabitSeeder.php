<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HabitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Shalat Tahajud',
                'description' => 'Shalat malam sebelum subuh',
                'icon'        => 'moon',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Shalat Dhuha',
                'description' => 'Shalat sunnah di pagi hari',
                'icon'        => 'sun',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Baca Al-Quran',
                'description' => 'Membaca Al-Quran setiap hari',
                'icon'        => 'book-quran',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Dzikir Pagi',
                'description' => 'Dzikir setelah shalat Subuh',
                'icon'        => 'star',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Dzikir Petang',
                'description' => 'Dzikir setelah shalat Ashar',
                'icon'        => 'star-half-alt',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Sedekah',
                'description' => 'Berinfak atau sedekah',
                'icon'        => 'hand-holding-heart',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Istighfar',
                'description' => 'Memohon ampunan Allah',
                'icon'        => 'praying-hands',
                'is_active'   => 1,
            ],
            [
                'name'        => 'Silaturahmi',
                'description' => 'Menghubungi keluarga atau teman',
                'icon'        => 'users',
                'is_active'   => 1,
            ],
        ];

        // Insert data
        $this->db->table('habits')->insertBatch($data);
    }
}
