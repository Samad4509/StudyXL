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
        if (!Schema::hasTable('agent_employees')) {
    Schema::create('agent_employees', function (Blueprint $table) {
        $table->bigIncrements('id'); // employee primary key, auto-increment
        $table->unsignedInteger('agent_id'); // must match Agent.id type
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->boolean('is_active')->default(1);
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('agent_id')
              ->references('id')
              ->on('agents')
              ->onDelete('cascade');
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_employees');
    }
};
