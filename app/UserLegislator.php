<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLegislator extends Model
{
    //
    protected $fillable = ['user_id','legislator_id'];
    
    public function legislator()
    {
        return $this->belongsTo('App\Legislator', 'legislator_id')->withDefault();
    }
}
