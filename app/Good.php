<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    protected $table = 'good';
    protected $guarded = ['id','updated_at','created_at'];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
}
