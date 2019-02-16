@extends('layouts.base')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{$series->image_url}})" data-overlay="8">
    <div class="container text-center">

        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">

                <h1>{{$series->title}}s</h1>
                <p class="fs-18 opacity-70">{{$series->description}}</p>

            </div>
        </div>

    </div>
</header>
@stop

@section('content')
<div class="section bg-grey">
    <div class="container">

        <div class="row gap-y">
            <div class="col-6">

                <h2 class="text-center ">Edit</h2>
                <br>

                <form action="{{ route('series.update', $series->slug)  }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="text" value="{{ $series->title }}" name="title" placeholder="Your Series title">
                    </div>

                    <div class="form-group">
                        <input class="form-control form-control-lg" type="file" name="image">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Your Description">{{ $series->description }}</textarea>
                    </div>


                    <button class="btn btn-lg btn-primary btn-block" type="submit">Update series</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop