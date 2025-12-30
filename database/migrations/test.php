<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('university_programs', function (Blueprint $table) {
            // Additional program info
            $table->string('application_fee')->nullable()->after('program_description');
            $table->string('application_short_desc')->nullable()->after('application_fee');

            $table->string('average_graduate_program')->nullable()->after('application_short_desc');
            $table->string('average_graduate_program_short_desc')->nullable()->after('average_graduate_program');

            $table->string('average_undergraduate_program')->nullable()->after('average_graduate_program_short_desc');
            $table->string('average_undergraduate_program_short_desc')->nullable()->after('average_undergraduate_program');

            $table->string('cost_of_living')->nullable()->after('average_undergraduate_program_short_desc');
            $table->string('cost_of_living_short_desc')->nullable()->after('cost_of_living');

            $table->string('average_gross_tuition')->nullable()->after('cost_of_living_short_desc');
            $table->string('average_gross_tuition_short_desc')->nullable()->after('average_gross_tuition');
            $table->string('campus_city')->nullable();
            $table->string('duration')->nullable();
            $table->longText('success_chance')->nullable();
            $table->string('program_summary')->nullable();
        });
    }

    public function down()
    {
        Schema::table('university_programs', function (Blueprint $table) {
            $table->dropColumn([
                'application_fee',
                'application_short_desc',
                'average_graduate_program',
                'average_graduate_program_short_desc',
                'average_undergraduate_program',
                'average_undergraduate_program_short_desc',
                'cost_of_living',
                'cost_of_living_short_desc',
                'average_gross_tuition',
                'average_gross_tuition_short_desc',
            ]);
        });
    }
};
