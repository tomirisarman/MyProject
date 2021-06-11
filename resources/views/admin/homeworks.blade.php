
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
    @include('layouts.adminnav')

    <div class="container">

        <table class="table table-bordered">
            <tbody>
            @foreach($result as $course => $lessons)
                <tr class="bg-dark text-white">
                    <td colspan="4"><h3>{{$course}}</h3></td>
                </tr>
                @foreach($lessons as $lesson => $hws)
                    <tr class="bg-secondary text-white">
                        <td colspan="4"><h4>{{$lesson}}</h4></td>
                    </tr>
                    @foreach($hws as $hw)
                        <tr>
                            <td>{{$hw->users->name}}</td>
                            <td>
                                @if(isset($hw->score))
                                    <form id="edit_score" action="{{route('edit_score', $hw->id)}}">
                                        <input type="number" name="score" min=1 max=100 value={{$hw->score}}>
                                    </form>
                                @else
                                    Нет оценки
                                @endif
                            </td>
                            <td><button type="button" class="btn btn-info" onclick="$('#edit_score').submit();">Изменить оценку</button></td>
                            <td>
                                <form id="edit_score" action="{{route('delete_hw', $hw->id)}}">
                                    <input type="submit" class="btn btn-danger" value="Удалить ДЗ">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>

    </div>
{{--   <div class="container">--}}
{{--       @foreach($hws as $h)--}}
{{--           <p>{{$h->lessons->courses->name}}</p>--}}
{{--           <p>{{$h->lessons->title}}</p>--}}
{{--           <p>{{$h->users->name}}</p>--}}
{{--           <p>{{\App\Lesson::where('id', $h->lesson_id)->first()->title}}</p>--}}
{{--       @endforeach--}}
{{--   </div>--}}
{{--    <div class="container">--}}
{{--        @foreach($ls as $l)--}}
{{--            <p>{{$l->courses->name}}</p>--}}
{{--        @endforeach--}}
{{--    </div>--}}
@endsection
