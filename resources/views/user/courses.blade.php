@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@include('layouts.sidenav')
<div class="container">
    <table class="table table-dark table-striped">
        @foreach ($c as $course)
            <tr>
                <form method="POST" action="{{route('add_course', $course->id)}}">
                    @csrf
                    <td>
                        <span>{{$course->name}}</span>
                    </td>
                    <td>
                        <span>{{App\Teacher::where('id', $course->teacher_id)->first()['name']}}</span>
                    </td>
                    <td style="float: right">
                        @if (in_array($course->id, $user_courses, TRUE))
                            <input type="submit" disabled value="Add course">
                        @else
                            <input type="submit" value="Add course">
                        @endif 
                    </td>  
                </form>
            </tr>
        @endforeach
    </table>
</div>
@endsection