<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->text('options');
            $table->text('solution');
            $table->integer('level');
            $table->text('hint')->nullable();
            $table->integer('answer');
            $table->integer('problem_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_questions');
    }
}
