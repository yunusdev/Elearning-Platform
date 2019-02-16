@extends('layouts.base')

@section('header')
    <header class="header header-inverse" style="background-color: #1ac28d">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{$user->name}}</h1>
                    <br>
                    <h1>{{ $user->getTotalNumberOfCompletedLessons() }}</h1>
                    <p class="fs-20 opacity-70">Lessons completed</p>
                </div>
            </div>

        </div>
    </header>
@stop


@section('content')

    <section class="section" id="section-vtab">
        <div class="container">
            @if($seriesStarted->count() > 0)
            <header class="section-header">
                <h2>Series being watched ...</h2>
                <hr>
            </header>
            @endif


            <div class="row gap-5">
                @forelse($seriesStarted as $s)
                    <div class="card mb-30" style="">
                        <div class="row">
                            <div class="col-12 col-md-4 align-self-center">
                                <a href=""><img src="{{ $s->image_url }}" alt="..."></a>
                            </div>

                            <div class="col-12 col-md-8" style="border: 2px solid silver; border-left-color: white; margin-left: -17px">
                                <span class="label label-info pull-right rounded mt-2 mb-2" style="padding: 5px; background-color:#1ac28d; color: white">{{$user->getPerCompleteSeries($s)}}% Completed</span>
                                <div class="card-block">
                                    <h4 class="card-title">{{ $s->title }}</h4>

                                    <p class="card-text">{{ $s->description }}</p>
                                    <a class="fw-600 fs-12" href="{{ route('series.learning', [$s->slug]) }}">Read more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <h2 class="text-center"style="position: center">Havent Started any Series!</h2>

                @endforelse

            </div>


        </div>
    </section>

@endsection