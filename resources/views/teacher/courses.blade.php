@extends('layouts.app')

@section('content')
    @include('layouts.teachnav')

   <div class="container">
       <form action="">
           @csrf
           <label for="c_name">Название курса</label>
           <input type="text" name="c_name" id="c_name">
           <input class="btn btn-success" type="submit" value="Создать">
       </form>
       <table class="table table-bordered">
           <tbody>
           @foreach($arr as $course => $lessons)
               <tr>
                   <td colspan="3"><h2>{{$course}}</h2></td>
               </tr>
                @foreach($lessons as $les)
                    <tr>
                        <td>{{$les->title}}</td>
                        <?php $format = explode('.', $les->material)[1] ?>
                        <td>
                            <a href="{{asset($les->material)}}"  download="{{ $course.' '.$les->title.'.'.$format }}">
                                <button class="btn btn-link">Скачать материалы</button>
                            </a>
                        </td>
                        <?php $format = explode('.', $les->assignment)[1] ?>
                        <td>
                            <a href="{{asset($les->assignment)}}"  download="{{ 'DZ '.$les->title.'.'.$format }}">
                                <button class="btn btn-link">Скачать ДЗ</button>
                            </a>
                        </td>
                    </tr>
                @endforeach

               <form action="" enctype="multipart/form-data">
                   @csrf
                   <table class="container table table-bordered">
                       <tr>
                           <td>
                               <label for="title">Тема урока</label>
                               <input type="text" name="title">
                           </td>
                           <td>
                               <label for="material">Материалы</label>
                               <input type="file" name="material">
                           </td>
                           <td>
                               <label for="assignment">ДЗ</label>
                               <input type="file" name="assignment">
                           </td>
                           <td>
                               <input class="btn btn-success" style="float: right" type="submit" value="Добавить урок">
                           </td>
                       </tr>
                   </table>
               </form>
            @endforeach
           </tbody>
       </table>
   </div>
@endsection
