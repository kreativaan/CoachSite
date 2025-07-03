<template>
    <div class="max-w-6xl mx-auto p-6 mt-16">
        <!-- Search -->
        <input
            type="text"
            v-model="searchQuery"
            placeholder="Search posts..."
            @input="search"
            class="border border-gray-300 rounded-xl p-2 w-full mb-6"
        />

        <h1 class="text-3xl font-bold mb-8">Latest Blog Posts</h1>

        <div v-if="posts.length === 0" class="text-gray-600 text-center mt-10">
            No posts yet.
        </div>
        <!-- posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                v-for="post in posts"
                :key="post.id"
                class="bg-white rounded-xl overflow-hidden shadow-xl transition mb-6 hover:scale-105 hover:shadow-2xl"
            >
                <a :href="`/blog/${post.id}`">
                    <img
                        v-if="post.image"
                        :src="`/uploads/${post.image}`"
                        alt="Post image"
                        class="w-full h-64 object-cover"
                    />
                    <div class="p-4">
                        <h2 class="text-xl font-bold mb-2 text-blue-600">
                            {{ post.title }}
                        </h2>
                        <p class="text-gray-700">
                            {{ post.content.slice(0, 150) }}...
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex space-x-2 justify-center mt-4">
            <button
                v-for="page in lastPage"
                :key="page"
                @click="goToPage(page)"
                :class="{
                    'bg-blue-500 text-white': currentPage === page,
                    'bg-gray-200': currentPage !== page,
                }"
                class="px-3 py-1 rounded"
            >
                {{ page }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: 1,
            searchQuery: "",
        };
    },
    methods: {
        async fetchPosts(page = 1) {
            const response = await fetch(
                `/api/posts?page=${page}&search=${this.searchQuery}`
            );
            const data = await response.json();

            this.posts = data.data;
            this.currentPage = data.current_page;
            this.lastPage = data.last_page;
        },
        search() {
            this.fetchPosts(1); // reset to page 1 when searching
        },
        goToPage(page) {
            this.fetchPosts(page);
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>
