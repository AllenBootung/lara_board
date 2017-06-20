<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsgReply extends Model
{
    protected $fillable = [
        'MSG_NO',
        'REPLY_MESSAGE',
        'PERSON_NO'
    ];
    protected $primaryKey = "REPLY_NO";
}
