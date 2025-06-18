<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('logo')->nullable();
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->text('description');
            $table->string('salary')->nullable();
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'freelance', 'internship'])->default('full-time');
            $table->enum('experience_level', ['entry', 'junior', 'mid', 'senior', 'lead', 'executive'])->default('mid');
            $table->date('application_deadline')->nullable();
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['title', 'company']);
            $table->index('tags');
            $table->index('location');
            $table->index('job_type');
            $table->index('experience_level');
            $table->index('created_at');
        });

        // PostgreSQL-specific full-text search indexes (optional enhancement)
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('CREATE INDEX listings_title_gin ON listings USING gin(to_tsvector(\'english\', title))');
            DB::statement('CREATE INDEX listings_description_gin ON listings USING gin(to_tsvector(\'english\', description))');
            DB::statement('CREATE INDEX listings_tags_gin ON listings USING gin(to_tsvector(\'english\', tags))');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}; 