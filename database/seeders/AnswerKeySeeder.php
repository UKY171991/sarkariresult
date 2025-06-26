<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnswerKey;
use App\Models\JobPost;

class AnswerKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobPosts = JobPost::all();

        foreach ($jobPosts->take(3) as $jobPost) {
            AnswerKey::create([
                'job_post_id' => $jobPost->id,
                'title' => $jobPost->title . ' - Answer Key',
                'slug' => \Str::slug($jobPost->title . ' Answer Key'),
                'description' => 'Download the official answer key for ' . $jobPost->title . ' examination.',
                'organization' => $jobPost->organization,
                'exam_date' => $jobPost->exam_date ?? now()->subDays(7),
                'download_link' => 'https://example.com/answer-keys/' . \Str::slug($jobPost->title) . '.pdf',
                'official_website' => $jobPost->official_website ?? 'https://example.com',
                'instructions' => 'Download the official answer key and check your responses. Results will be declared soon.',
                'status' => 'active',
                'downloads' => rand(1000, 8000)
            ]);
        }
    }
}
