<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseIdAndCourseChapterIdToSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_chapter_sections', function (Blueprint $table) {
            $table->integer('sequence')->default(0);
            $table->integer('course_id')->unsigned();
            $table->integer('course_chapter_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_chapter_sections', function (Blueprint $table) {
            $table->dropColumn('sequence');
            $table->dropColumn('course_id');
            $table->dropColumn('course_chapter_id');
        });
    }
}
