@extends('layouts.base')


@section('header')

    <!-- Header -->
    <header class="header header-inverse" style="background-color: #c2b2cd;">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>Portfolio</h1>
                    <p class="fs-20 opacity-70">You can find several product design by our professional team in this section.</p>

                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->

@endsection

@section('content')

    <h3 class="section-info mt-3 text-center" id="contact-2"><a href="#contact-2">Create Series</a></h3>
    <div class="section">
        <div class="container">

            <div class="row gap-y">
                <div class="col-12 col-md-8">
                    @include('include._alert')
                    <form action="{{route('series.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="title" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <input class="form-control form-control-lg" type="file" name="image_url" placeholder="Image Url">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Your Description"></textarea>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Series</button>
                    </form>

                </div>


            </div>


        </div>
    </div>


@endsection