<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdmitCard;
use App\Models\JobPost;

class AdmitCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobPosts = JobPost::all();

        foreach ($jobPosts->take(3) as $jobPost) {
            AdmitCard::create([
                'job_post_id' => $jobPost->id,
                'title' => $jobPost->title . ' - Admit Card',
                'slug' => \Str::slug($jobPost->title . ' Admit Card'),
                'description' => 'Download your admit card for ' . $jobPost->title . ' examination.',
                'organization' => $jobPost->organization,
                'exam_date' => $jobPost->exam_date ?? now()->addDays(30),
                'download_link' => 'https://example.com/admit-cards/' . \Str::slug($jobPost->title) . '.pdf',
                'official_website' => $jobPost->official_website ?? 'https://example.com',
                'instructions' => 'Please download your admit card and carry it to the examination center. Ensure all details are correct.',
                'status' => 'active',
                'downloads' => rand(500, 5000)
            ]);
        }
    }
}
