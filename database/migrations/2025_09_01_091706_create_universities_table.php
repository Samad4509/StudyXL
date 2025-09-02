<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone_number')->nullable();
            
            $table->json('images')->nullable(); // store multiple images as JSON
            
            // Institution Details
            $table->integer('founded')->nullable();
            $table->string('school_id')->nullable();
            $table->string('dli_number')->nullable();
            $table->string('institution_type')->nullable();
            
            // Cost and Duration
            $table->decimal('amount', 15, 2)->nullable();
            $table->text('amount_desc')->nullable();
            $table->decimal('one_year', 15, 2)->nullable();
            $table->text('one_year_desc')->nullable();
            $table->integer('course_years')->nullable();
            $table->text('course_years_desc')->nullable();
            $table->decimal('amount_years', 15, 2)->nullable();
            $table->text('amount_years_desc')->nullable();
            $table->decimal('first_year_amount', 15, 2)->nullable();
            $table->text('first_year_desc')->nullable();
            $table->string('application_processing_time')->nullable();
            
            // Top Disciplines
            $table->json('top_disciplines')->nullable(); // store subjects + percentage
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('universities');
    }
};
