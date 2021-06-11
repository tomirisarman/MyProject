<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    public function courses(){
        return $this->belongsTo('App\Course', 'course_id');
    }
    public function homeworks(){
        return $this->hasMany('App\Homework');
    }
}
