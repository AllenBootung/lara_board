<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('msg_reply', function ($table) {
            $table->timestamps();
            $table->dropColumn('REPLY_TIME');
            $table->text('REPLY_MESSAGE')->change();
            
        });

        Schema::table('msg_list', function ($table) {
            $table->timestamps();
            $table->dropColumn('MSG_TIME');
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
        Schema::drop('msg_reply');
    }
}
