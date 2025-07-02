@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

    <body class="bg-gray-100 h-full">
        <div id="app">
            <nav-bar></nav-bar>
            <edit-post :id="{{ $id }}"></edit-post>
        </div>
    @endsection
