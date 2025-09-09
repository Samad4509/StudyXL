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
        Schema::create('field_o_f_subjects', function (Blueprint $table) {
            $table->id();
            
            // Proper foreign key to field_of_studies
            $table->foreignId('field_of_study_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('study_field_name');
            $table->string('subject_name'); // e.g., Physics
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_o_f_subjects');
    }
};
