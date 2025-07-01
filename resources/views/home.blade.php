<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Home | CoachSite</title>
</head>

<body class="bg-gray-100 text-gray-800">

    <div id="app">
        <nav-bar></nav-bar>

        <!-- Hero Section -->
        <section class="bg-blue-400 text-white py-16 text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to CoachSite</h1>
            <p class="text-xl mb-6">Your personal fitness coach and guide</p>
            <a href="/contact"
                class="bg-white text-blue-500 px-6 py-2 rounded shadow hover:bg-gray-200 font-semibold transition">
                Contact Me
            </a>
        </section>

        <!-- About Section -->
        <section class="max-w-4xl mx-auto py-12 px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Meet Your Coach</h2>
            <p class="text-lg">
                I'm a certified personal trainer with a passion for helping people achieve their fitness goals. Whether
                you're looking to lose weight, build muscle, or just live healthier – I'm here to help you every step of
                the way.
            </p>
        </section>

        <!-- Blog Preview (Vue Component) -->
        <section class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 ">
                <h2 class="text-2xl font-bold mb-6">Latest Blog Posts</h2>
                <blog-preview class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" />
            </div>
        </section>
    </div>
</body>

</html>
