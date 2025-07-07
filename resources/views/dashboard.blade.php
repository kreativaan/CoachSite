<x-app-layout title="Admin Dashboard">
    <div class="max-w-6xl mx-auto p-6 mt-16">

        <h1 class="text-3xl font-bold mb-6">Welcome, {{ $adminName }}!</h1>

        {{-- STATS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <x-dashboard-card title="Total Blog Posts" :count="$postCount" color="blue" link="/blog"
                linkText="Manage Posts →" />
            <x-dashboard-card title="Total Messages" :count="$messageCount" color="blue" link="/admin/messages"
                linkText="View Inbox →" />
            <x-dashboard-card title="Unread Messages" :count="$unreadMessageCount" color="red" />
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white p-6 rounded-xl shadow mb-10">
            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <a href="/admin/blog" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">➕ New Post</a>
                <a href="/admin/messages" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">📥 View
                    Inbox</a>
                <a href="/trainer" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">✏️ Edit Trainer
                    Profile</a>
            </div>
        </div>

        {{-- RECENT POSTS --}}
        <div class="bg-white p-6 rounded-xl shadow mb-10">
            <h2 class="text-xl font-semibold mb-4">Recent Blog Posts</h2>
            @forelse ($recentPosts as $post)
                <div class="border-b pb-2 mb-2">
                    <a href="/blog/{{ $post->id }}" class="text-blue-600 hover:underline font-medium">
                        {{ $post->title }}
                    </a>
                    <p class="text-sm text-gray-500">Published {{ $post->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-600">No recent posts.</p>
            @endforelse
        </div>

        {{-- RECENT MESSAGES --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-4">Recent Messages</h2>
            @forelse ($recentMessages as $message)
                <div class="border-b pb-2 mb-2">
                    <p class="font-medium">{{ $message->name }} <span
                            class="text-sm text-gray-500">({{ $message->email }})</span></p>
                    <p class="text-sm text-gray-600 italic">“{{ Str::limit($message->message, 100) }}”</p>
                    <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-600">No recent messages.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
