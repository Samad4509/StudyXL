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
        // Schema::create('tasks', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
        //     $table->date('due_date');
        //     $table->unsignedBigInteger('student_id')->nullable();
        //     $table->string('student_name')->nullable();
        //     $table->unsignedBigInteger('agent_id')->nullable();
        //     $table->string('agent_name')->nullable();
        //     $table->unsignedBigInteger('university_id')->nullable();
        //     $table->string('university_name')->nullable();
        //     $table->unsignedBigInteger('program_id')->nullable();
        //     $table->string('program_name')->nullable();
        //     $table->json('documents')->nullable(); // <-- multiple documents stored as JSON
        //      $table->unsignedBigInteger('updated_by')->nullable();
        //     $table->timestamps();
        //         });

                if (!Schema::hasTable('tasks')) {
                    Schema::create('tasks', function (Blueprint $table) {
                        $table->id();
                        $table->string('title');
                        $table->string('subject')->nullable();
                        $table->string('description')->nullable();
                        $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
                        $table->date('due_date');
                        $table->unsignedBigInteger('student_id')->nullable();
                        $table->string('student_name')->nullable();
                        $table->unsignedBigInteger('agent_id')->nullable();
                        $table->string('agent_name')->nullable();
                        $table->unsignedBigInteger('university_id')->nullable();
                        $table->string('university_name')->nullable();
                        $table->unsignedBigInteger('program_id')->nullable();
                        $table->string('program_name')->nullable();
                        $table->json('documents')->nullable(); // <-- multiple documents stored as JSON
                        $table->unsignedBigInteger('updated_by')->nullable();
                        $table->timestamps();
                            });
                }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
