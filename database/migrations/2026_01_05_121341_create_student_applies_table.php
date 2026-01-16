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
        // Schema::create('student_applies', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('student_id');
        //     $table->string('student_name');
        //     $table->string('program_id');
        //     $table->string('program_name');
        //     $table->string('university_name');
        //     $table->string('intake');
        //     $table->enum('status', ['Submitted', 'Pending', 'Accepted', 'Rejected'])->default('Submitted');
        //     $table->timestamps();
        // });

         if (!Schema::hasTable('student_applies')) {
                Schema::create('student_applies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id');
                $table->string('student_name');
                $table->string('program_id');
                $table->string('program_name');
                $table->string('university_name');
                $table->string('intake');
                $table->enum('status', ['Submitted', 'Pending', 'Accepted', 'Rejected'])->default('Submitted');
                $table->timestamps();
            });
         }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applies');
    }
};
