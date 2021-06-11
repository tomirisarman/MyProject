<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function teacher_courses(){
        $userId = Auth::id();
        $courses = Course::where('teacher_id', $userId)->get();

        $arr = [];
        foreach ($courses as $c){
            $lessons = $c->lessons;
            $arr[$c->name] = $lessons;
        }
       return view('teacher.courses', compact('arr'));

    }
}
