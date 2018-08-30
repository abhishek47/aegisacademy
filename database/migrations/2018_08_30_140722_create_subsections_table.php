<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('banner');
            $table->integer('content_type')->default(0);
            $table->text('body')->nullable();
            $table->string('video')->nullable();
            $table->integer('problem_id')->nullable();
            $table->integer('completed')->default(0);
            $table->integer('sequence')->default(0);
            $table->integer('course_id')->unsigned();
            $table->integer('course_chapter_id')->unsigned();
            $table->integer('course_section_id')->unsigned();
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
        Schema::dropIfExists('subsections');
    }
}
