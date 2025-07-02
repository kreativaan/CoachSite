<template>
    <div
        class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-16 mb-20"
        v-if="post"
    >
        <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>

        <div v-if="post.image" class="mb-6 flex justify-center">
            <img
                :src="`/uploads/${post.image}`"
                class="rounded-lg shadow max-h-[400px]"
                alt="Post image"
            />
        </div>

        <p
            class="text-gray-700 mb-6 whitespace-pre-line text-lg leading-relaxed"
        >
            {{ post.content }}
        </p>

        <p class="text-sm text-gray-500">
            Posted on: {{ formatDate(post.created_at) }}
        </p>

        <div v-if="user && user.is_admin" class="flex gap-4 mt-6">
            <a
                :href="`/admin/blog/edit/${post.id}`"
                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
            >
                Edit
            </a>
            <button
                @click="deletePost"
                class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none"
            >
                Delete
            </button>
        </div>
        <CommentSection :post-id="id"></CommentSection>
    </div>
</template>

<script>
import CommentSection from "./CommentSection.vue";

export default {
    data() {
        return {
            post: null,
            user: window.authUser || null,
        };
    },
    components: {
        CommentSection,
    },
    props: ["id"],
    methods: {
        async fetchPost() {
            try {
                const response = await fetch(`/api/posts/${this.id}`);
                this.post = await response.json();
            } catch (error) {
                console.error("Failed to load post:", error);
            }
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        },
        async deletePost() {
            if (!confirm("Are you sure you want to delete this post?")) return;

            const res = await fetch(`/api/posts/${this.post.id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ _method: "DELETE" }),
            });

            const result = await res.json();
            alert(result.message);
            window.location.href = "/blog";
        },
    },
    mounted() {
        this.fetchPost();
    },
};
</script>
