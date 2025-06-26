<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description');
            $table->string('organization');
            $table->integer('total_posts')->nullable();
            $table->string('location')->nullable();
            $table->decimal('application_fee', 8, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('official_website')->nullable();
            $table->string('notification_pdf')->nullable();
            $table->string('application_link')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
