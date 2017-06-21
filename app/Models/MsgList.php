<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsgList extends Model
{
    protected $fillable =[
      'PERSON_NO',
      'MSG_TITLE',
      
    ];
    protected $primaryKey = "MSG_NO";
    protected $table = 'msg_lists';
}
