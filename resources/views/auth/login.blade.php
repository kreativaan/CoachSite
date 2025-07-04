<x-guest-layout>
    <x-slot name="title">Login</x-slot>

    <h1 class="text-2xl font-bold mb-4">Login to Your Account</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label for="password" class="block font-medium">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div class="flex justify-between items-center">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">Login</button>

        <p class="text-sm text-center mt-4">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
        </p>
    </form>
</x-guest-layout>
