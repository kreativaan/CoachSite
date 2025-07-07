<x-app-layout title="View Message">
    <div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4">Message from {{ $message->name }}</h2>

        <p><strong>Email:</strong> {{ $message->email }}</p>
        <p class="mb-4"><strong>Message:</strong> {{ $message->message }}</p>

        <form method="POST" action="{{ route('messages.reply', $message->id) }}">
            @csrf
            <label class="block font-semibold mb-2" for="reply">Reply</label>
            <textarea name="reply" id="reply" rows="5" class="w-full p-3 rounded border border-gray-300">{{ $message->reply }}</textarea>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Save Reply</button>
        </form>

        @if (session('success'))
            <p class="mt-4 text-green-600">{{ session('success') }}</p>
        @endif
    </div>
</x-app-layout>
