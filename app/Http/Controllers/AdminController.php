<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show_courses(){
        return view('admin.courses');
    }

    public function create(Request $req){
        $c_name = $req->c_name;
        $t_id = $req->teacher;

        $course = new Course();
        $course->name = $c_name;
        $course->teacher_id = $t_id;
        $course->save();
        // return redirect('create_course')->with('message', 'Created!');
        return back()->with('message', 'Created!');
    }

    public function delete(Request $req, $c_id){
        $course = Course::find($c_id);
        $course->delete();
        // return redirect('create_course')->with('message', 'Deleted!');
        return back()->with('message', 'Deleted!');
    }

    public function show_lessons()
    {
        $courses = Course::get();
        $teachers = Teacher::get();
        $lessons = Lesson::get();

        $result = array();
        foreach($courses as $c){
            $result[$c->name] = array();
            foreach($lessons as $l){
                if($c->id == $l->course_id){
                    $result[$c->name][]=[$l->title, $l->material];
                }
            }
        }

        return view('admin.lessons', compact('result'));
    }

}
