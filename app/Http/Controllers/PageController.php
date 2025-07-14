<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

        // If no new file, but existing_photo was sent, merge it into the request
        if (!$request->hasFile('profile_photo') && $request->filled('existing_photo')) {
            $request->merge(['profile_photo' => $request->input('existing_photo')]);
        }

        // validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'specialty' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'profile_photo' => 'nullable|string',
        ]);

        try {
            $trainer = Trainer::first();

            // Handle new photo upload
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $validated['profile_photo'] = $filename;
            }

            // Update or create
            if ($trainer) {
                $trainer->update($validated);
            } else {
                Trainer::create($validated);
            }

            return response()->json(['message' => 'Trainer profile updated']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save profile: ' . $e->getMessage()], 500);
        }
    }


    public function contact()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validate);

        return response()->json(['message' => 'Message sent successfully']);
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
