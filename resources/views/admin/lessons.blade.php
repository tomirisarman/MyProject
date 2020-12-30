@extends('layouts.app')

@section('content')
<?
    $courses = App\Course::get();
    $teachers = App\Teacher::get();
    $lessons = App\Lesson::get();
?>
@include('layouts.adminnav')

<table class="container table table-striped">
    @foreach ($result as $course=>$lessons)
        <tr>
            <td colspan="2">
                <p>{{$course}}</p>
            </td>
            <td>
                <form action="" method="POST">
                    @csrf
                    <input class="btn btn-success" type="submit" value="Add new lesson">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                @foreach ($lessons as $lesson)
                    <p>{{$lesson[0]}}</p>
                @endforeach
            </td>
            <td>
                @foreach ($lessons as $lesson)
                    <p>{{$lesson[1]}}</p>
                @endforeach
            </td>
            <td>
                @foreach ($lessons as $lesson)
                    <p><a href="{{asset($lesson[1])}}" download="{{$course.' '.$lesson[0]}}">Скачать материалы</a></p>
                @endforeach 
            </td>
        </tr>
    @endforeach
</table>

@endsection