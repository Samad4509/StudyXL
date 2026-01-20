<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the table
        Schema::dropIfExists('applications');
    }

    public function down(): void
    {
        // Optional: recreate table if rollback needed
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->integer('student_id');
            $table->string('agent_name');
            $table->integer('agent_id');
            $table->string('program_id');
            $table->string('program_name');
            $table->string('university_name');
            $table->string('intake');
            $table->enum('status', ['Submitted', 'Pending', 'Accepted', 'Rejected'])->default('Submitted');
            $table->timestamps();
        });
    }
};
