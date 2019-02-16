<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    //

    public function index(){

        $user = auth()->user();

        $seriesStarted = $user->getSeriesBeingWatched();

        return view('user.profile', compact('user', 'seriesStarted'));

    }
}
