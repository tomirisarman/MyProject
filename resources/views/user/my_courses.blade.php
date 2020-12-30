@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@include('layouts.sidenav')
<div class="container">
    <table class="table table-dark table-striped">
    @foreach ($user_courses as $course)
    <tr>
        <td>{{App\Course::find($course)->name}}</td>
        <td>{{App\Teacher::where('id', App\Course::find($course)->teacher_id)->first()['name']}}</td>
        <td style="float: right"><a href="{{route('view_lessons', $course)}}"> View Lessons</a></td>
    </tr>
    @endforeach
</table>
</div>

@endsection