
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
<?
    $courses = App\Course::get();
    $teachers = App\Teacher::get();
    $lessons = App\Lesson::get();
?>
@include('layouts.adminnav')
    @foreach ($result as $course=>$lessons)
    <form action="{{route('add_lesson', $course)}}" method="POST" enctype="multipart/form-data">
        @csrf
    <table class="container table table-striped table-bordered">
        <tr>
            <td colspan="3">
                <h3>{{$course}}</h3>
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
                    <? $format = explode('.', $lesson[1])[1] ?>
                    <p><a href="{{asset($lesson[1])}}"  download="{{ $course.' '.$lesson[0].'.'.$format }}">Скачать материалы</a></p>
                @endforeach 
            </td>
        </tr>
        <tr>
                <td>
                
                   
                    <label for="title">Lesson title</label>
                    <input type="text" name="title">
                </td>
                <td>
                    <label for="material">Materials</label>
                    <input type="file" name="material">
                </td>
                <td>
                    <input class="btn btn-success" type="submit" value="Add new lesson">
                
                </td>
           
        </tr>
    </table>
</form>
    @endforeach

@endsection
