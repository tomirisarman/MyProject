
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
@include('layouts.adminnav')
    @foreach ($result as $course=>$lessons)
    <table class="container table table-bordered">
        <tr >
            <td colspan="4" class="table-dark">
                <h3>{{$course}}</h3>
            </td>
        </tr>
        @foreach ($lessons as $lesson)
        <tr>
            <td>
                {{-- @foreach ($lessons as $lesson) --}}
                    <p>{{$lesson[0]}}</p>
                {{-- @endforeach --}}
            </td>
            <td>
                {{-- @foreach ($lessons as $lesson) --}}
                    <p>{{$lesson[1]}}</p>
                {{-- @endforeach --}}
            </td>
            <td>
                {{-- @foreach ($lessons as $lesson) --}}
                    <? $format = explode('.', $lesson[1])[1] ?>
                    <p><a href="{{asset($lesson[1])}}"  download="{{ $course.' '.$lesson[0].'.'.$format }}">
                        <button class="btn btn-link">Скачать материалы</button>
                    </a></p>
                    @if($lesson[2])
                    <? $format = explode('.', $lesson[2])[1] ?>
                    <p><a href="{{asset($lesson[2])}}"  download="{{ 'ДЗ '.$course.' '.$lesson[0].'.'.$format }}">
                        <button class="btn btn-link">Скачать ДЗ</button>
                    </a></p>
                    @endif
                {{-- @endforeach  --}}
            </td>
            <td>
                {{-- @foreach ($lessons as $lesson) --}}
                <form action="{{route('del_lesson', $lesson[3])}}" method="POST">
                    @csrf
                    <p><input class="btn btn-link" type="submit" value="Удалить"></p>
                    {{-- <p><a href="" onclick="parentNode.submit();">Удалить</a></p> --}}
                </form>

            </td>
        </tr>
        @endforeach
    </table>


    <form action="{{route('add_lesson', $course)}}" method="POST" enctype="multipart/form-data">
        @csrf
    <table class="container table table-striped">
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
                <label for="assignment">Assignment</label>
                <input type="file" name="assignment">
            </td>
            <td>
                <input class="btn btn-success" style="float: right" type="submit" value="Add new lesson">
            </td>
        </tr>
    </table>
    </form>


    @endforeach

@endsection
