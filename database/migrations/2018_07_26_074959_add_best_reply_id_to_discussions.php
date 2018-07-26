<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBestReplyIdToDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->integer('best_reply_id')->default(0)->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropColumn('best_reply_id');
        });
    }
}
