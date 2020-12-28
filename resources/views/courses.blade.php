@foreach ($c as $course)
<p>{{$course->name}} - {{$t->where('id', $course->teacher_id)}}</p>

@endforeach

{{-- <?echo $t; ?> --}}