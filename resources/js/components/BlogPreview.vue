<template>
    <div>
        <div v-if="posts.length === 0" class="text-gray-600">No posts yet.</div>

        <div
            v-for="post in posts.slice(0, 3)"
            :key="post.id"
            class="mb-6 bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition"
        >
            <a :href="`/blog/${post.id}`">
                <h3 class="text-xl font-semibold text-blue-600 mb-2">
                    {{ post.title }}
                </h3>
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
            const response = await fetch("/api/posts");
            this.posts = await response.json();
        },
        preview(content) {
            return content.length > 100
                ? content.slice(0, 100) + "..."
                : content;
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-US", {
                year: "numeric",
                month: "short",
                day: "numeric",
            });
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>
