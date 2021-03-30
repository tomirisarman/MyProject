<?php

namespace App\Http\Controllers;

use App\Homework;
use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Teacher;
use Illuminate\Support\Facades\File;
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

    public function edit_course(Request $req, $c_id){
        $course = Course::find($c_id);
        $course->name=$req->c_name;
        $course->teacher_id=$req->t_id;
        $course->save();
        return back()->with('message', 'Edited!');
    }

    public function show_lessons()
    {
        $courses = Course::get();
        $lessons = Lesson::get();

        $result = array();
        foreach($courses as $c){
            $result[$c->name] = array();
            foreach($lessons as $l){
                if($c->id == $l->course_id){
                    $result[$c->name][]=[$l->title, $l->material, $l->assignment, $l->id];
                }
            }
        }

        return view('admin.lessons', compact('result'));
    }
    // public function download_lesson($path)
    // {
    //     return response()->download($path);
    // }
    public function add_lesson(Request $req, $course)
    {
        $lesson = new Lesson();
        $lesson->title = $req->title;
        $course_col = Course::where('name', $course)->first();
        $lesson->course_id = $course_col->id;

        if(!public_path('materials/'.$course.'/')){
            File::makeDirectory(public_path('materials/'.$course.'/'), 0775, true);
        }

        $req->material->move(public_path('materials/'.$course.'/'), $req->material->getClientOriginalName());
        $lesson->material = "materials/".$course.'/'.$req->material->getClientOriginalName();

        if(!public_path('assignments/'.$course.'/')){
            File::makeDirectory(public_path('assignments/'.$course.'/'), 0775, true);
        }

        $req->assignment->move(public_path('assignments/'.$course.'/'), $req->assignment->getClientOriginalName());
        $lesson->assignment = "assignments/".$course.'/'.$req->assignment->getClientOriginalName();

        $lesson->save();
        return back()->withInput();
    }

    public function delete_lesson($l_id)
    {
        $lesson = Lesson::find($l_id);
        $filepath = $lesson->material;
        unlink(public_path($filepath));
        $lesson->delete();
        return back()->withInput();
    }

    public function show_homeworks()
    {
        $hws = Homework::get();
        return view('admin.homeworks', compact('hws'));
    }
}
