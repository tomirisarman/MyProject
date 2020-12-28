<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;

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
    public function show_courses(Request $req)
    {
        $c = Course::all();
        $t = Teacher::all();
        return view('courses', compact('c', 't'));
    }
}
