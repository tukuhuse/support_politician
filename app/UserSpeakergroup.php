<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSpeakergroup extends Model
{
    //
    protected $table = 'user_speaker_groups';
    protected $fillable = ['user_id','speaker_group_id'];
}
