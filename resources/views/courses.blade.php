@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@foreach ($c as $course)
    <form method="POST" action="{{route('add_course', $course->id)}}">
        @csrf
        <label for="course">{{$course->name}} - {{App\Teacher::where('id', $course->teacher_id)->first()['name']}}</label>
            
            @if (in_array($course->id, $user_courses, TRUE))
                <input type="submit" disabled value="Add course">
            @else
                <input type="submit" value="Add course">
            @endif 
            
    </form>
@endforeach

@endsection