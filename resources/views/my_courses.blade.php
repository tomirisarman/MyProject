@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@foreach ($user_courses as $course)
<p>{{App\Course::find($course)->name}} - {{App\Teacher::where('id', App\Course::find($course)->teacher_id)->first()['name']}}</p>
<a href="{{route('view_lessons', $course)}}"> View Lessons</a>
@endforeach

@endsection