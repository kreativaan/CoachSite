<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
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

        $validated = $request->validate([
            'name' => 'required|string|max:225',
            'bio' => 'nullable|string',
            'specialty' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0'
        ]);

        Trainer::create($validated);

        return response()->json([
            'message' => 'Trainer profile saved successfully',

        ]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        return response()->json([
            'message' => 'Message sent successfully'
        ]);
    }
}
