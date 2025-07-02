@extends('layouts.app')

@section('title', 'Blog Post')

@section('content')

    <body class="bg-gray-100">
        <div id="app">
            <nav-bar></nav-bar>
            <blog-post :id="{{ $id }}"></blog-post>
        </div>
    @endsection
