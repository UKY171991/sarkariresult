<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Railway Jobs',
                'slug' => 'railway-jobs',
                'description' => 'Latest Railway recruitment notifications and job opportunities',
                'icon' => 'fas fa-train',
                'sort_order' => 1
            ],
            [
                'name' => 'Banking Jobs',
                'slug' => 'banking-jobs',
                'description' => 'Bank recruitment notifications and financial sector jobs',
                'icon' => 'fas fa-university',
                'sort_order' => 2
            ],
            [
                'name' => 'SSC Jobs',
                'slug' => 'ssc-jobs',
                'description' => 'Staff Selection Commission recruitment notifications',
                'icon' => 'fas fa-user-tie',
                'sort_order' => 3
            ],
            [
                'name' => 'UPSC Jobs',
                'slug' => 'upsc-jobs',
                'description' => 'Union Public Service Commission recruitment',
                'icon' => 'fas fa-crown',
                'sort_order' => 4
            ],
            [
                'name' => 'Teaching Jobs',
                'slug' => 'teaching-jobs',
                'description' => 'Education sector job opportunities and teacher recruitment',
                'icon' => 'fas fa-chalkboard-teacher',
                'sort_order' => 5
            ],
            [
                'name' => 'Police Jobs',
                'slug' => 'police-jobs',
                'description' => 'Police and security force recruitment notifications',
                'icon' => 'fas fa-shield-alt',
                'sort_order' => 6
            ],
            [
                'name' => 'Defense Jobs',
                'slug' => 'defense-jobs',
                'description' => 'Military and defense sector recruitment',
                'icon' => 'fas fa-fighter-jet',
                'sort_order' => 7
            ],
            [
                'name' => 'State Government Jobs',
                'slug' => 'state-government-jobs',
                'description' => 'State government recruitment notifications',
                'icon' => 'fas fa-building',
                'sort_order' => 8
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
