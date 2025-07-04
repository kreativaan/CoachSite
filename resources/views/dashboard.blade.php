<x-app-layout title="Admin Dashboard">
    <div class="max-w-6xl mx-auto p-6 mt-16">
        <h1 class="text-3xl font-bold mb-6">Welcome, {{ $adminName }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Posts Card -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Total Blog Posts</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $postCount }}</p>
                <a href="/admin/blog" class="text-blue-500 hover:underline mt-2 inline-block">Manage Posts →</a>
            </div>

            <!-- Messages Card -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Total Messages</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $messageCount }}</p>
                <a href="/admin/messages" class="text-blue-500 hover:underline mt-2 inline-block">View Inbox →</a>
            </div>

            <!-- Unread Messages (optional) -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Unread Messages</h2>
                <p class="text-3xl font-bold text-red-500">{{ $unreadMessageCount }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
