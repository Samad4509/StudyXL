<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('intake_months', function (Blueprint $table) {
            $table->string('status')->default('likely_open')->after('submission_deadline');
        });
    }

    public function down()
    {
        Schema::table('intake_months', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
