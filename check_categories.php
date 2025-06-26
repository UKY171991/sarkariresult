<?php
require_once 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Categories in database:\n";
$categories = \App\Models\Category::all(['name', 'slug', 'is_active']);

foreach ($categories as $category) {
    echo "Name: {$category->name}, Slug: {$category->slug}, Active: " . ($category->is_active ? 'Yes' : 'No') . "\n";
}

echo "\nTesting specific banking-jobs category:\n";
$bankingCategory = \App\Models\Category::where('slug', 'banking-jobs')->first();

if ($bankingCategory) {
    echo "Found banking-jobs category: {$bankingCategory->name}\n";
} else {
    echo "No banking-jobs category found!\n";
}
?>
