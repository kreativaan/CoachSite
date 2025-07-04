<x-guest-layout>
    <x-slot name="title">Register</x-slot>

    <h1 class="text-2xl font-bold mb-4">Create Your Account</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="password" class="block font-medium">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">Register</button>

        <p class="text-sm text-center mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a>
        </p>
    </form>
</x-guest-layout>
