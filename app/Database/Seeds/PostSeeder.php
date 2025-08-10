<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PostSeeder extends Seeder
{
    public function run()
    {
        $categories = ['job', 'result', 'admit_card'];
        $now = Time::now();
        $builder = $this->db->table('posts');

        $rows = [];
        for ($i = 1; $i <= 20; $i++) {
            $cat = $categories[array_rand($categories)];
            $title = ucfirst($cat) . " Post $i";
            $rows[] = [
                'title' => $title,
                'slug' => strtolower(str_replace(' ', '-', $title)) . "-$i",
                'summary' => 'Sample summary for ' . $title,
                'category' => $cat,
                'external_url' => 'https://example.com/' . $cat . '/' . $i,
                'status' => 'published',
                'published_at' => $now->subDays(rand(0, 30))->toDateTimeString(),
                'created_at' => $now->toDateTimeString(),
                'updated_at' => $now->toDateTimeString(),
            ];
        }

        $builder->insertBatch($rows);
    }
}
