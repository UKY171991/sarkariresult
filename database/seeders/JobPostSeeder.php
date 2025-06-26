<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobPost;
use App\Models\Category;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $railwayCategory = Category::where('slug', 'railway-jobs')->first();
        $bankingCategory = Category::where('slug', 'banking-jobs')->first();
        $sscCategory = Category::where('slug', 'ssc-jobs')->first();

        $jobPosts = [
            [
                'category_id' => $railwayCategory->id,
                'title' => 'Railway Group D Recruitment 2025',
                'slug' => 'railway-group-d-recruitment-2025',
                'short_description' => 'Indian Railway Group D recruitment for various posts',
                'description' => '<p>Indian Railway is conducting recruitment for Group D posts. This is a golden opportunity for candidates looking for government jobs in the railway sector.</p><p><strong>Important Details:</strong></p><ul><li>Total Posts: 1,03,769</li><li>Educational Qualification: 10th Pass</li><li>Age Limit: 18-33 years</li><li>Selection Process: CBT + Physical Efficiency Test</li></ul>',
                'organization' => 'Indian Railway',
                'total_posts' => 103769,
                'location' => 'All India',
                'application_fee' => 250.00,
                'start_date' => '2025-07-01',
                'end_date' => '2025-07-31',
                'exam_date' => '2025-09-15',
                'official_website' => 'https://rrc.indianrailways.gov.in',
                'status' => 'active',
                'is_featured' => true
            ],
            [
                'category_id' => $bankingCategory->id,
                'title' => 'SBI PO Recruitment 2025',
                'slug' => 'sbi-po-recruitment-2025',
                'short_description' => 'State Bank of India Probationary Officer recruitment',
                'description' => '<p>State Bank of India has released notification for Probationary Officer posts. This is one of the most prestigious banking exams in India.</p><p><strong>Important Details:</strong></p><ul><li>Total Posts: 2,000</li><li>Educational Qualification: Graduation</li><li>Age Limit: 21-30 years</li><li>Selection Process: Prelims + Mains + Interview</li></ul>',
                'organization' => 'State Bank of India',
                'total_posts' => 2000,
                'location' => 'All India',
                'application_fee' => 750.00,
                'start_date' => '2025-06-15',
                'end_date' => '2025-07-15',
                'exam_date' => '2025-08-20',
                'official_website' => 'https://sbi.co.in/careers',
                'status' => 'active',
                'is_featured' => true
            ],
            [
                'category_id' => $sscCategory->id,
                'title' => 'SSC CGL 2025 Notification',
                'slug' => 'ssc-cgl-2025-notification',
                'short_description' => 'Staff Selection Commission Combined Graduate Level Examination',
                'description' => '<p>SSC has released the notification for Combined Graduate Level Examination 2025. This exam is conducted for recruitment to various Group B and Group C posts.</p><p><strong>Important Details:</strong></p><ul><li>Total Posts: 17,727</li><li>Educational Qualification: Graduation</li><li>Age Limit: 18-32 years</li><li>Selection Process: Tier I + Tier II + Tier III + Skill Test</li></ul>',
                'organization' => 'Staff Selection Commission',
                'total_posts' => 17727,
                'location' => 'All India',
                'application_fee' => 100.00,
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-30',
                'exam_date' => '2025-08-01',
                'official_website' => 'https://ssc.nic.in',
                'status' => 'active',
                'is_featured' => false
            ]
        ];

        foreach ($jobPosts as $jobPost) {
            JobPost::create($jobPost);
        }
    }
}
