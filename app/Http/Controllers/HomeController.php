<?php

namespace App\Http\Controllers;

use App\Course;
use App\Homework;
use App\Lesson;
use App\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // public function add_course(Request $req)
    // {
    //     $c = new Course();
    //     $c->name = $req['name'];
    //     $c->save();
    //     return view('home');
    // }
    public function show_courses()
    {
        $c = Course::all();
        return view('user.courses', compact('c'));
    }

    public function add_course(Request $req, $c_id)
    {
        $c = Course::find($c_id);
        $user = Auth::user();
        DB::statement("UPDATE users SET courses=JSON_ARRAY_APPEND(courses, '$', ".$c->id.") WHERE id=".$user->id);
        return redirect('my_courses');
    }
    public function view_lessons($c_id)
    {
        $lessons = Lesson::where('course_id', $c_id)->get();

//        foreach($lessons as $les){
//            $hws = $les->homeworks;
//            foreach ($hws as $hw){
//                if($hw->users->id == Auth::user()->id){
//                    print_r('mew');
//                }
//            }
//        }
        return view('user.lessons', compact('lessons'));
    }

    public function upload_hw(Request $req, $l_id)
    {
        $file = $req->homework;
        $lesson = Lesson::find($l_id);
        $course = $lesson->courses->name;
        if(!public_path('homeworks/'.$course.'/'.$lesson->title.'/')){
            File::makeDirectory(public_path('homeworks/'.$course.'/'.$lesson->title.'/'), 0775, true);
        }

        $file->move(public_path('homeworks/'.$course.'/'.$lesson->title.'/'), $file->getClientOriginalName());

        $hw = new Homework();
        $hw->user_id = Auth::user()->id;
        $hw->lesson_id = $l_id;
        $hw->hw_file = "homeworks/".$course.'/'.$file->getClientOriginalName();
        $hw->save();
        return back()->withInput();
    }

}
