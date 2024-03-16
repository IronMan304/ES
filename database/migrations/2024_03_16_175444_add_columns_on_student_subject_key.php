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
        Schema::table('student_subject_key', function (Blueprint $table) {
            $table->string('first_grading_grade');
            $table->string('second_grading_grade');
            $table->string('third_grading_grade');
            $table->string('fourth_grading_grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_subject_key', function (Blueprint $table) {
            $table->dropColumn('first_grading_grade');
            $table->dropColumn('second_grading_grade');
            $table->dropColumn('third_grading_grade');
            $table->dropColumn('fourth_grading_grade');
        });
    }
};
