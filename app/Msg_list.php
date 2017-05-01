<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg_list extends Model
{
    protected $table = 'msg_list';

    protected $fillable = [
        'MSG_TITLE',
        'MSG_TIME',
        'PERSON_NO'
    ];
}
