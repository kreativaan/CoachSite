<x-app-layout title="Admin Inbox">
    <div class="max-w-4xl mx-auto p-6 mt-10">
        <h1 class="text-2xl font-bold mb-4">Admin Inbox</h1>

        @if ($messages->isEmpty())
            <p>No messages yet.</p>
        @else
            @foreach ($messages as $message)
                <div class="bg-white rounded-lg shadow p-4 mb-4">
                    <p><strong>Name:</strong> {{ $message->name }}</p>
                    <p><strong>Email:</strong> {{ $message->email }}</p>
                    <p><strong>Message:</strong> {{ $message->message }}</p>
                    <a href="{{ route('messages.show', $message->id) }}"
                        class="text-blue-600 hover:underline mt-2 mb-2 inline-block">
                        View & Reply →
                    </a>
                    <p class="text-sm text-gray-500">Sent at: {{ $message->created_at->format('F j, Y, g:i a') }}</p>

                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
