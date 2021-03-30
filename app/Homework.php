<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function lessons(){
        return $this->belongsTo('App\Lesson');
    }
}
