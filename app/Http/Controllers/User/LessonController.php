<?php

namespace App\Http\Controllers\User;

use App\Model\Lesson;
use App\Model\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    //
    public function index(Series $series, Lesson $lesson){

        $user = auth()->user();

        return view('user.lesson.index', compact('series', 'lesson', 'user'));

    }

    public function completeLesson(Lesson $lesson, Request $request){

        return auth()->user()->completeLesson($lesson);

    }
}
