<template>
    <div class="max-w-6xl mx-auto p-6 mt-16">
        <h1 class="text-3xl font-bold mb-6">Latest Blog Posts</h1>

        <div v-if="posts.length === 0" class="text-gray-600 text-center mt-10">
            No posts yet.
        </div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a
                :href="`/blog/${post.id}`"
                v-for="post in posts"
                :key="post.id"
                class="bg-white rounded-xl shadow-lg p-4 hover:shadow-2xl hover:scale-[1.01] transition-all duration-300"
            >
                <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>

                <div v-if="post.image" class="mb-4 flex justify-center">
                    <img
                        :src="`/uploads/${post.image}`"
                        class="max-h-48 w-full object-cover rounded-md"
                        alt="Post image"
                    />
                </div>

                <p class="text-gray-700 mb-2">{{ preview(post.content) }}</p>
                <p class="text-sm text-gray-500">
                    {{ formatDate(post.created_at) }}
                </p>
            </a>
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
            return content.length > 200
                ? content.slice(0, 200) + "..."
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
