@extends('layouts.app')

@section('title', 'About the Trainer')

@section('content')

    <body class="bg-gray-100 text-gray-800 mt-16">
        <div id="app">
            <nav-bar></nav-bar>
            <div class="max-w-2xl mx-auto p-8 bg-white mt-12 rounded shadow">
                <h1 class="text-2xl font-bold mb-4">Meet Your Trainer</h1>

                @if ($trainer->profile_photo)
                    <img src="{{ asset('uploads/' . $trainer->profile_photo) }}" class="w-48 mb-4 rounded-lg shadow" />
                @endif

                <p><strong>Name:</strong> {{ $trainer->name }}</p>
                <p><strong>Specialty:</strong> {{ $trainer->specialty }}</p>
                <p><strong>Experience:</strong> {{ $trainer->years_experience }} years</p>
                <p><strong>Bio:</strong></p>
                <p class="mt-2">{{ $trainer->bio }}</p>
            </div>
        </div>

    @endsection
