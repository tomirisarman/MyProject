@extends('layouts.app')

@section('content')
        {{-- <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div> --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <div class="container-fluid box">
        <div class="">
            <h1 class="">hello</h1>
        </div>
        
    </div>
        
@endsection
