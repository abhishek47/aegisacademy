<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemQuestionSolutionUpvotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pquestion_solution_upvotes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('problem_question_solution_id')->unsigned()->index();
            $table->foreign('problem_question_solution_id')->references('id')->on('problem_question_solutions')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('pquestion_solution_upvotes');
    }
}
