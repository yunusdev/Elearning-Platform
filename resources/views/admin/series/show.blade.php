@extends('layouts.base')


@section('header')
    <header class="header header-inverse bg-fixed" style="background-image: url({{$series->image_url}})" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{$series->title}}</h1>
                    <p class="fs-18 opacity-70">{{$series->description}}</p>

                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->

@endsection

@section('content')

    <h3 class="section-info mt-2 text-center" id="contact-2" style="margin-bottom: -70px"><a href="#contact-2">Lessons</a></h3>
    <div class="section">
        <div class="container">

            <div class="row gap-y">
                <div class="col-12">
                    <vue-lesson default_lessons = "{{$series->lessons()->first()->getOrderedLessons()}}" series_id="{{$series->id}}"></vue-lesson>
                </div>


            </div>


        </div>
    </div>


@endsection