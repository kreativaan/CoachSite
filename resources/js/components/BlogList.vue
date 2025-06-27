<template>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Latest Blog Posts</h1>

        <div v-if="posts.length === 0">No posts yet.</div>

        <div
            v-for="post in posts"
            :key="post.id"
            class="bg-white rounded-lg shadow-md p-6 mb-6"
        >
            <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>

            <div v-if="post.image" class="mb-4 flex justify-center">
                <img
                    :src="`/uploads/${post.image}`"
                    class="w-100 rounded-md shadow-xl"
                    alt="Post image"
                />
            </div>

            <p class="text-gray-700 mb-2">{{ preview(post.content) }}</p>
            <p class="text-sm text-gray-500">
                {{ formatDate(post.created_at) }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        };
    },
    methods: {
        async fetchPosts() {
            try {
                const response = await fetch("/api/posts");
                const data = await response.json();
                this.posts = data;
            } catch (error) {
                console.error("Failed to load posts:", error);
            }
        },
        preview(content) {
            return content.length > 250
                ? content.slice(0, 250) + "..."
                : content;
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>
