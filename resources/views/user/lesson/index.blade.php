@extends('layouts.base')

@section('header')
    <header class="header header-inverse" style="background-color: #9ac29d">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{ $lesson->title }}</h1>
                    <p class="fs-20 opacity-70">{{  $series->title }}</p>


                    @hasStartedSeries($series)

                        <h2 class="">{{round($user->getPerCompleteSeries($series))}}% Completed</h2><br>

                    @endhasStartedSeries

                    <a href="{{ route('series', $series->slug) }}" class="btn btn-lg btn-primary mr-16 btn-round">Return To Index Page</a>
                </div>
            </div>

        </div>
    </header>
@stop

@section('content')
    @php
        $nextLesson = $lesson->getNextLesson();
        $prevLesson = $lesson->getPrevLesson();
    @endphp

    <div class="section bg-grey">
        <div class="container">

            <vue-player next_lesson_url = "{{ route('lesson.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ]) }}" default_lesson="{{$lesson}}"></vue-player>

            @if($prevLesson->id !== $lesson->id)
                <a href="{{ route('lesson.watch', ['series' => $series->slug, 'lesson' => $prevLesson->id ]) }}" class="btn btn-info btn-lg pull-left">Prev Lesson</a>
            @endif
            @if($nextLesson->id !== $lesson->id)
                <a href="{{ route('lesson.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ]) }}" class="btn btn-info btn-lg pull-right">Next Lesson</a>
            @endif

        </div>
    </div>
    <div class="col-8 offset-2 mt-3">
        <ul class="list-group">
            @foreach($series->getOrderedLessons() as $l)
                <li class="list-group-item d-flex justify-content-between align-items-center
                @if($l->id == $lesson->id)
                        active
                @endif" style="@if($l->id == $lesson->id) background-color: #0facf3; border-color: #0facf3 @endif">

                    <a href="{{ route('lesson.watch', ['series' => $series->slug, 'lesson' => $l->id]) }}" style="@if($l->id == $lesson->id) color: white; background-color: #0facf3 @endif" >
                        <span class="badge badge-success mr-2" style="background-color: grey; color: white">
                            {{$loop->iteration}}</span> {{ $l->title }}
                    </a>
                    @if($user->hasCompletedLesson($l))
                        <span class="badge badge-primary badge-pill"><i class="fa fa-check "></i></span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

@stop