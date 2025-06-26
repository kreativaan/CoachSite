<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function trainer()
    {
        return view('trainer');
    }

    public function saveTrainerProfile(Request $request)
    {

        return response()->json([
            'message' => 'Trainer profile save successfully',
            'data' => request()->all(),
        ]);
    }
}
