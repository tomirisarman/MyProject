@extends('layouts.app')

@section('content')

@include('layouts.sidenav')
<div class="container">
    <table class="table">
        <tbody>
        <tr>
            <td>Тема урока</td>
            <td>Материалы</td>
            <td>ДЗ</td>
            <td>Оценка</td>
        </tr>
        @foreach ($lessons as $les)
            <tr>
                <td><p>{{$les->title}}</p></td>
            <?php
            $format = explode('.', $les->material)[1];
            $hw = \App\Homework::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('lesson_id', $les->id)->first();
            ?>
            <td><a href="{{asset($les->material)}}" download="{{$les->title}}.{{$format}}">Скачать материалы</a></td>
            @if(isset($les->assignment))
                <?php $format = explode('.', $les->assignment)[1]?>
                <td><a href="{{asset($les->assignment)}}" download="DZ-{{$les->title}}.{{$format}}">Скачать ДЗ</a></td>
                @if(isset($hw))
                        <td><p>{{$hw->score ? $hw->score : 'Не выставлена'}}</p></td>
                @else
                <td>
                    <form action="{{route('upload_hw', $les->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="homework">Загрузить ДЗ: </label>
                        <input type="file" name="homework">
                        <input type="submit" value="Отправить">
                    </form>
                </td>
                @endif
            @endif
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endsection
