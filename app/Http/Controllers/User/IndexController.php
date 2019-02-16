<?php

namespace App\Http\Controllers\User;

use App\Model\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function welcome(){

        $series = Series::all();

        return view('welcome', compact('series'));

    }
}
