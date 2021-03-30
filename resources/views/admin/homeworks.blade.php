
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
    @include('layouts.adminnav')
   <div class="container">
       @foreach($hws as $h)
           <p>{{\App\Lesson::where('id', $h->lesson_id)->first()->title}}</p>
       @endforeach
   </div>

@endsection
