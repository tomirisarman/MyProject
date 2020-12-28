<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function lessons(){
        return $this->hasMany('App\Lesson');
    }
    public function users(){
        return $this->hasMany('App\User');
    }
    public function teachers(){
        return $this->belongsTo('App\Teacher');
    }
}
