<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $c = Course::find($c_id);
        $lessons = Lesson::where('course_id', $c_id)->get();
        // $title = $lessons->title;
        // $material = $lessons->material;
        // // var_dump($lessons);
        return view('user.lessons', compact('lessons'));
    }

}
