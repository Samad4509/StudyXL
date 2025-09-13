<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('university_name');
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone_number')->nullable();
            $table->json('images')->nullable();
            $table->integer('founded')->nullable();
            $table->string('school_id')->nullable();
            $table->string('institution_type')->nullable();
            $table->string('dli_number')->nullable();
            $table->json('top_disciplines')->nullable();
             // New detailed fields
            $table->string('application_fee')->nullable();
            $table->string('application_short_desc')->nullable();

            $table->string('average_graduate_program')->nullable();
            $table->string('average_graduate_program_short_desc')->nullable();

            $table->string('average_undergraduate_program')->nullable();
            $table->string('average_undergraduate_program_short_desc')->nullable();

            $table->string('cost_of_living')->nullable();
            $table->string('cost_of_living_short_desc')->nullable();

            $table->string('average_gross_tuition')->nullable();
            $table->string('average_gross_tuition_short_desc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('universities');
    }
};
