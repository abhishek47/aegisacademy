<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectiveToBookChapterQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_chapter_questions', function (Blueprint $table) {
            $table->integer('is_subjective')->default(0);
            $table->string('subjective_answer')->nullable();
            $table->integer('answer')->nullable()->change();
            $table->text('options')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_chapter_questions', function (Blueprint $table) {
            $table->dropColumn('is_subjective');
            $table->dropColumn('subjective_answer');
            $table->integer('answer')->change();
            $table->text('options')->change();
        });
    }
}
