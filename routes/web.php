<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm')->name('login.teacher');

Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/teacher', 'Auth\RegisterController@showTeacherRegisterForm')->name('register.teacher');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');

Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/teacher', 'Auth\RegisterController@createTeacher')->name('register.teacher');

Route::view('/home', 'home')->middleware('auth');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/our_courses', 'HomeController@show_courses')->name('courses');
    Route::view('/my_courses', 'user.my_courses')->name('my_courses');
    Route::get('/view_lessons/{c_id?}', 'HomeController@view_lessons')->name('view_lessons');
    Route::post('/add/{c_id?}', 'HomeController@add_course')->name('add_course');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
    Route::view('/courses', 'admin.courses')->name('admin.courses');
    Route::get('/lessons', 'AdminController@show_lessons')->name('admin.lessons');
    Route::post('/create', 'AdminController@create')->name('create');
    Route::post('/delete/{c_id?}', 'AdminController@delete')->name('delete_course');
    Route::post('/edit/{c_id?}', 'AdminController@edit_course')->name('edit_course');

    Route::post('/add_lesson/{course?}', 'AdminController@add_lesson')->name('add_lesson');
    Route::post('/del_lesson/{l_id?}', 'AdminController@delete_lesson')->name('del_lesson');

    Route::get('/homeworks', 'AdminController@show_homeworks')->name('admin.homeworks');

});

Route::group(['middleware' => 'auth:teacher'], function () {
    Route::view('/teacher', 'teacher');
});

// Route::post('/create', 'HomeController@add_course')->name('add_course');



// Route::get('/download/{path?}', 'AdminController@download_lesson')->name('download_lesson');
