<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookChapterQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_chapter_questions', function (Blueprint $table) {
             $table->increments('id');
            $table->text('question');
            $table->text('options');
            $table->text('solution');
            $table->integer('level');
            $table->text('hint')->nullable();
            $table->integer('answer');
            $table->integer('chapter_id');
            $table->integer('book_id')->default(0);
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
        Schema::dropIfExists('book_chapter_questions');
    }
}
