@extends('layouts.app')

@section('content')
<?
$user = Auth::user();
$user_courses = json_decode($user->courses);
?>
@include('layouts.sidenav')
<p>{{$title}}</p>
<a href="{{asset($material)}}" download="{{$title}}">Скачать материалы</a>
@endsection