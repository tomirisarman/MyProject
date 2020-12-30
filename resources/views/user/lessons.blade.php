@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@include('layouts.sidenav')
<div class="container">
    @foreach ($lessons as $les)
        <p>{{$les->title}}</p>
        <a href="{{asset($les->material)}}" download="{{$les->title}}">Скачать материалы</a>
    @endforeach
    {{-- <p>{{$title}}</p>
    <a href="{{asset($material)}}" download="{{$title}}">Скачать материалы</a> --}}
</div>

@endsection