<?php

namespace App\Http\Controllers\Admin;

use App\Model\Lesson;
use App\Model\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Series $series)
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Series $series, Request $request)
    {
        //
        $this->validate(request(), [

            'title' => 'required',
            'description' => 'required',
            'episode_number' => 'required',
            'video_id' => 'required',

        ]);

        return $series->lessons()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Series $series, Lesson $lesson, Request $request)
    {
        //
        $this->validate(request(), [

            'title' => 'required',
            'description' => 'required',
            'episode_number' => 'required',
            'video_id' => 'required',

        ]);

        $lesson->update($request->all());

        return $lesson->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series, Lesson $lesson)
    {
        //
        $lesson->delete();

        return response()->json(['status' => 'ok']);
    }
}
