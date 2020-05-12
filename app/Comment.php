<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded=['id','updated_at','created_at'];
    
    public function user_name()
    {
        return $this->belongsTo('App\User', 'user_id')->withDefault();
    }
}
