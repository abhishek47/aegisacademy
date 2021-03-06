<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHintsToProblemQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_questions', function (Blueprint $table) {
            $table->text('hint2')->nullable();
            $table->text('hint3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problem_questions', function (Blueprint $table) {
            $table->dropColumn('hint2');
            $table->dropColumn('hint3');
        });
    }
}
