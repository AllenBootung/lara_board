<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg_list extends Model
{
    protected $table = 'msg_reply';

    protected $fillable = [
        'REPLY_MESSAGE',
        'REPLY_TIME',
        'PERSON_NO'
    ];
}
