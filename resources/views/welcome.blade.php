@extends('layouts.base')


@section('header')

    <header class="header header-inverse h-fullscreen pb-80" style="background-image: url(assets/img/bg-cup.jpg);" data-overlay="8">
        <div class="container text-center">

            <div class="row h-full">
                <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

                    <h1 class="display-4 hidden-sm-down">E-learning Platform</h1>
                    <h1 class="hidden-md-up">Create Professional Websites</h1>
                    <br>
                    <p class="lead text-white fs-20 hidden-sm-down"><span class="fw-400">E-Learning </span>platform with series and lessons</p>

                    <br><br><br>

                    <a class="btn btn-lg btn-round w-200 btn-primary mr-16" href="#" data-scrollto="section-intro">Demos</a>
                    <a class="btn btn-lg btn-round w-200 btn-outline btn-white hidden-sm-down" href="#" data-scrollto="section-intro">Features</a>

                </div>

                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
                </div>

            </div>

        </div>
    </header>

@endsection

@section('content')

    <div class="container">
        <h2 class="text-center mt-2">Series</h2>
        <br>


        <div class="row gap-y">

            @forelse($series as $s)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-bordered card-hover-shadow">
                        <a href="{{route('series', $s->slug)}}"><img height="300" class="card-img-top" src="{{$s->image_url}}" alt="Card image cap"></a>
                        <div class="card-block">
                            <h4 class="card-title"><a href="{{route('series', $s->slug)}}">{{$s->title}}</a></h4>
                            <p class="card-text">{{str_limit($s->description, 100)}}</p>
                            <a class="fw-600 fs-12" href="{{route('series', $s->slug)}}">Learn more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                        </div>
                    </div>
                </div>
            @empty

                <h5>No Series</h5>

            @endforelse

        </div>

        <br><br>
        <p class="text-center"><a href="#">Browse all blog posts</a></p>


    </div>




@endsection