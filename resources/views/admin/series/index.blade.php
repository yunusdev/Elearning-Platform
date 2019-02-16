@extends('layouts.base')

@section('header')

    <header class="header header-inverse" style="background-color: #c2b2cd;">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>All series (Admin Page)</h1>
                    <p class="fs-20 opacity-70">Let's make the world a better place for coders</p>

                </div>
            </div>

        </div>
    </header>
@stop

@section('content')
    <div class="section bg-grey">
        <div class="container">

            <div class="row gap-y">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <th>Img</th>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>
                        <tbody>
                        @forelse($series as $s)
                            <tr>
                                <td><a href="{{ route('series.show', $s->slug) }}"><img height="30" width="30" src="{{$s->image_url}}" alt=""></a></td>
                                <td><a href="{{ route('series.show', $s->slug) }}">{{ $s->title }}</a></td>
                                <td>
                                    <a href="{{ route('series.edit', $s->slug) }}" class="btn btn-info">Edit</a>
                                </td>
                                <td>
                                    <a onclick="event.preventDefault(); document.getElementById('delete-series-{{$s->id}}').submit()" style="color: white" class="btn btn-danger">Delete</a>

                                    <form id="delete-series-{{$s->id}}" action="{{ route('series.destroy', $s->slug) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p class="text-center">No series yet</p>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop