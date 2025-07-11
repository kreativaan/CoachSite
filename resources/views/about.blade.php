<x-app-layout title="About the Trainer">

    <div class="max-w-3xl mx-auto p-8 mt-16 bg-white rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Meet Your Trainer</h1>

        <div class="flex flex-col md:flex-row items-center gap-8">
            @if ($trainer->profile_photo)
                <img src="{{ asset('uploads/' . $trainer->profile_photo) }}" alt="Trainer photo"
                    class="w-40 h-40 object-cover rounded-full border-4 border-blue-500 shadow-md" />
            @endif

            <div class="text-gray-700 space-y-3">
                <div>
                    <h2 class="text-lg font-semibold"> Name:</h2>
                    <p>{{ $trainer->name }}</p>
                </div>

                <div>
                    <h2 class="text-lg font-semibold"> Specialty:</h2>
                    <p>{{ $trainer->specialty }}</p>
                </div>

                <div>
                    <h2 class="text-lg font-semibold"> Experience:</h2>
                    <p>{{ $trainer->years_experience }} years</p>
                </div>
            </div>
        </div>

        <hr class="my-6 border-t border-gray-200">

        <div class="text-gray-700">
            <h2 class="text-xl font-semibold mb-2"> Bio</h2>
            <p class="leading-relaxed">{{ $trainer->bio }}</p>
        </div>
    </div>

</x-app-layout>
