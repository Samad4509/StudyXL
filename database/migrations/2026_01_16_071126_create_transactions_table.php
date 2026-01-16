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
        
          if (!Schema::hasTable('transactions')) {
                Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->string('agent_name');
                $table->string('agent_id');
                $table->string('student_name');
                $table->string('student_id');
                $table->string('university');
                $table->string('program');
                $table->decimal('tuition_fee', 8, 2);
                $table->decimal('paid_amount', 8, 2);
                $table->decimal('balance_due', 8, 2);
                $table->enum('status', ['Partial', 'Fully Paid', 'Unpaid'])->default('Unpaid');
                $table->decimal('comm_percent', 5, 2);
                $table->decimal('comm_earned', 8, 2)->default(0);
                $table->timestamps();
            });
          }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
