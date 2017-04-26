<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_list', function (Blueprint $table) {
            $table->increments('MSG_NO');
            $table->integer('PERSON_NO');
            $table->string('MSG_TITLE', 30); // 新增
            $table->string('MSG_TIME', 20);
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
        Schema::drop('msg_list');
    }
}
