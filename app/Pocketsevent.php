<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pocketsevent extends Model
{
   protected $table = 'events';
   protected $fillable = [
            'id','user_id','event_name','created_at','updated_at'
    ];
}
