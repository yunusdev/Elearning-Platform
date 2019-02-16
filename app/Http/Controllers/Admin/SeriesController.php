<?php

namespace App\Http\Controllers\Admin;

use App\Model\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $series = Series::all();

        return view('admin.series.index', compact('series'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate(request(), [
           'title' => 'required|max:191|unique:series',
           'image_url' => 'required',
           'description' => 'required'
        ]);

        if ($file = $request->file('image_url')){

            $name = '/SeriesImages/' . time() . $file->getClientOriginalName();

            $file->move('SeriesImages', $name);
        }

        $series = new Series();

        $series->title = $request->title;
        $series->description = $request->description;
        $series->image_url = $name;

        $series->save();

        return redirect(route('series.show', $series->slug));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {

        return view('admin.series.show', compact('series'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        //
        return view('admin.series.edit', compact('series'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series)
    {
        //
        $this->validate(request(), [
            'title' => 'required|max:191',
            'description' => 'required'
        ]);

        if ($file = $request->file('image_url')){

            $name = '/SeriesImages/' . time() . $file->getClientOriginalName();

            $file->move('SeriesImages', $name);

            $series->image_url = $name;

        }


        $series->title = $request->title;
        $series->description = $request->description;

        $series->save();

        return redirect(route('series.show', $series->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        $series->delete();

        return back();

    }
}
