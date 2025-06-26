<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdmitCardController;
use App\Models\JobPost;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing Admin Admit Card POST functionality...\n";

try {
    // Check if we have job posts
    $jobPosts = JobPost::where('status', 'active')->get();
    echo "Found " . $jobPosts->count() . " active job posts\n";
    
    if ($jobPosts->isEmpty()) {
        echo "No active job posts found. Creating a test job post...\n";
        $jobPost = JobPost::create([
            'title' => 'Test Job for Admit Card',
            'slug' => 'test-job-for-admit-card',
            'description' => 'Test job description',
            'organization' => 'Test Organization',
            'location' => 'Test Location',
            'qualification' => 'Test Qualification',
            'application_deadline' => now()->addMonth(),
            'salary' => '50000-60000',
            'status' => 'active',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        echo "Created test job post with ID: " . $jobPost->id . "\n";
    } else {
        $jobPost = $jobPosts->first();
        echo "Using existing job post: " . $jobPost->title . " (ID: " . $jobPost->id . ")\n";
    }
    
    // Check if we have admin users
    $adminUsers = User::where('role', 'admin')->get();
    echo "Found " . $adminUsers->count() . " admin users\n";
    
    if ($adminUsers->isEmpty()) {
        echo "No admin users found. Please create an admin user first.\n";
        exit(1);
    }
    
    // Simulate authenticated admin user
    $adminUser = $adminUsers->first();
    auth()->login($adminUser);
    echo "Authenticated as admin: " . $adminUser->email . "\n";
    
    // Create test request data
    $requestData = [
        'job_post_id' => $jobPost->id,
        'title' => 'Test Admit Card - ' . $jobPost->title,
        'description' => 'This is a test admit card description.',
        'organization' => 'Test Organization',
        'exam_date' => '2024-12-31',
        'download_link' => 'https://example.com/admit-card.pdf',
        'official_website' => 'https://example.com',
        'instructions' => 'Test instructions for downloading admit card.',
        'status' => 'active'
    ];
    
    echo "Creating test admit card with data:\n";
    print_r($requestData);
    
    // Create a mock request
    $request = Request::create('/admin/admit-cards', 'POST', $requestData);
    $request->headers->set('X-CSRF-TOKEN', csrf_token());
    
    // Test the controller
    $controller = new AdmitCardController();
    $response = $controller->store($request);
    
    echo "Response status: " . $response->getStatusCode() . "\n";
    
    if ($response->getStatusCode() === 302) {
        echo "Redirect to: " . $response->headers->get('Location') . "\n";
        $session = $request->session();
        if ($session && $session->has('success')) {
            echo "Success message: " . $session->get('success') . "\n";
        }
    }
    
    // Check if admit card was created
    $admitCard = \App\Models\AdmitCard::where('title', $requestData['title'])->first();
    if ($admitCard) {
        echo "✓ Admit card created successfully with ID: " . $admitCard->id . "\n";
        echo "  Title: " . $admitCard->title . "\n";
        echo "  Slug: " . $admitCard->slug . "\n";
        echo "  Status: " . $admitCard->status . "\n";
    } else {
        echo "✗ Admit card was not created\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
