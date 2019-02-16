<?php

namespace App\Http\Controllers\User;

use App\Model\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    //

    public function index(Series $series){

        $user = auth()->user();

        return view('user.series.index', compact('series', 'user'));
    }

    public function startLearning(Series $series){

        $lesson_to_watch = auth()->user()->getNextLessonToWatch($series);

        return redirect(route('lesson.watch', [$series->slug, $lesson_to_watch->id]));

    }
}
