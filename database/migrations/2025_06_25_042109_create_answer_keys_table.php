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
        Schema::create('answer_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('organization');
            $table->date('exam_date')->nullable();
            $table->string('download_link')->nullable();
            $table->string('official_website')->nullable();
            $table->text('instructions')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('downloads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_keys');
    }
};
