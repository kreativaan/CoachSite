<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class PageController extends Controller
{


    public function home()
    {
        return view('home');
    }

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
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'specialty' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Limit file size and types
        ]);

        try {
            $trainer = Trainer::first();

            // Handle photo upload if file exists
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $validated['profile_photo'] = $filename;
            }

            // Update or create trainer data
            if ($trainer) {
                $trainer->update($validated);
            } else {
                Trainer::create($validated);
            }

            return response()->json(['message' => 'Trainer profile updated']);
        } catch (\Exception $e) {
            // Return a more useful error message
            return response()->json(['error' => 'Failed to save profile: ' . $e->getMessage()], 500);
        }
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

    public function getTrainer()
    {
        $trainer = Trainer::first();
        return response()->json($trainer);
    }

    public function publicProfile()
    {
        $trainer = Trainer::first();
        return view('about', ['trainer' => $trainer]);
    }
}
