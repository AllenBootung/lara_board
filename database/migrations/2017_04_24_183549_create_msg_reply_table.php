<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_reply', function (Blueprint $table) {
            $table->increments('REPLY_NO');
            $table->integer('MSG_NO');
            $table->integer('PERSON_NO');
            $table->string('REPLY_MESSAGE', 30); // 新增
            $table->string('REPLY_TIME', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('msg_reply');
    }
}
