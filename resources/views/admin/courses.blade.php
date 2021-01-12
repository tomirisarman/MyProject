@extends('layouts.app')

@section('content')
<?
    $courses = App\Course::get();
    $teachers = App\Teacher::get();
?>
@include('layouts.adminnav')

<div class="container">
    <form action="{{route('create')}}" method="POST">
        @csrf
        <label for="c_name">Course name</label>
        <input type="text" name="c_name" id="c_name">
        <label for="teacher">Teacher</label>
        <select name="teacher" id="teacher">
            @foreach ($teachers as $t)
                <option value="{{$t->id}}">
                    {{$t->name}}
                </option>
            @endforeach
            
        </select>
        <input class="btn btn-success" type="submit" value="Create">
    </form>
    <table class="table table-dark table-striped">
        @foreach ($courses as $c)
            <tr>
                <td>{{$c->name}}</td>
                <? $t_name = App\Teacher::where('id', $c->teacher_id)->first()['name'];?>
                <td>{{$t_name}}</td>
                <td>
                    <button id="edit_btn" class="btn btn-primary" onclick="edit_course({{$c->id}})">Edit</button>
                </td>
                <td>
                    <form action="{{route('delete_course', $c->id)}}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                        <div id="edit_form_{{$c->id}}" style="display: none;">
                        <form action="{{route('edit_course', $c->id)}}" method="POST">
                            @csrf
                            <input type="text" name="c_name" value="{{$c->name}}">
                            <select name="t_id">
                                @foreach ($teachers as $t)
                                    @if($t_name==$t->name)
                                        <option selected value="{{$t->id}}">
                                            {{$t->name}}
                                        </option>
                                    @else
                                        <option value="{{$t->id}}">
                                            {{$t->name}}
                                        </option>
                                    @endif
                                @endforeach
                                
                            </select>
                            <input type="submit" class="btn btn-light" value="Submit">
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@if (session('message')=='Created!')
    <div class="container alert alert-success">
        {{ session('message') }}
    </div>
@elseif (session('message')=='Deleted!')
    <div class="container alert alert-danger">
        {{ session('message') }}
    </div>
@elseif (session('message')=='Edited!')
    <div class="container alert alert-success">
        {{ session('message') }}
    </div>
@endif

<script type="application/javascript">
    function edit_course(id){
        $('#edit_form_'+id).slideToggle('slow');

    }
    // $(document).ready(function(){

    // })
</script>
@endsection