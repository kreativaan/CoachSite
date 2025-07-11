<x-app-layout :title="$service['title']">

    <div class="max-w-3xl mx-auto mt-16 bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold mb-4">{{ $service['title'] }}</h1>
        <p class="text-gray-700 mb-6">{{ $service['description'] }}</p>

        {{-- Optional: Add "Book now" button --}}
        <a href="/contact" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Book This Service
        </a>
    </div>
    <div class="flex justify-center align-center mt-6 text-blue-500 hover:underline">
        <a href="/">
            Back to Home Page</a>
    </div>

</x-app-layout>
