<x-app-layout title="CoachSite">

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
        <h2 class="text-2xl font-bold">Meet Your Coach</h2>
        <p class="text-lg">
            I'm a certified personal trainer with a passion for helping people achieve their fitness goals. Whether
            you're looking to lose weight, build muscle, or just live healthier – I'm here to help you every step of
            the way.
        </p>
    </section>

    <services class="mb-8"></services>


    <!-- Blog Preview (Vue Component) -->
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 ">
            <h2 class="text-2xl font-bold mb-6">Latest Blog Posts</h2>
            <blog-preview class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" />
        </div>
    </section>

    <section>
        <div class="flex justify-center py-10  ">
            <a class="text-white py-2 px-6 shadow-lg bg-blue-500 hover:bg-blue-600 rounded-xl" href="/contact">Contact
                me</a>
        </div>
    </section>

</x-app-layout>
