<template>
    <div class="mt-10">
        <hr class="mb-6 opacity-15" />
        <h3 class="text-xl font-semibold mb-4">Comments</h3>

        <div v-if="comments.length === 0" class="text-gray-600">
            No comments yet.
        </div>

        <div
            v-for="comment in comments"
            :key="comment.id"
            class="mb-4 p-4 border rounded-md bg-green-50"
        >
            <p class="font-semibold">{{ comment.name }}</p>
            <p class="text-gray-700">{{ comment.content }}</p>
        </div>

        <form @submit.prevent="submitComment" class="mt-12">
            <h4 class="text-lg font-medium mb-2">Leave a Comment</h4>

            <div class="mb-3">
                <input
                    type="text"
                    v-model="form.name"
                    placeholder="Your name"
                    class="w-full border rounded p-2 bg-gray-100"
                    required
                />
            </div>

            <div class="mb-3">
                <textarea
                    v-model="form.content"
                    placeholder="Your comment"
                    class="w-full border rounded p-2 bg-gray-100"
                    required
                ></textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                Submit Comment
            </button>

            <SuccessMessage :message="successMessage" />
        </form>
    </div>
</template>

<script>
import SuccessMessage from "./SuccessMessage.vue";

export default {
    props: ["postId"],
    data() {
        return {
            comments: [],
            form: {
                name: "",
                content: "",
            },
            successMessage: "",
        };
    },
    components: {
        SuccessMessage,
    },
    methods: {
        async fetchComments() {
            try {
                const res = await fetch(`/api/posts/${this.postId}/comments`);
                this.comments = await res.json();
            } catch (error) {
                console.error("Failed to load comments", error);
            }
        },
        async submitComment() {
            try {
                const response = await fetch("/comments", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        post_id: this.postId,
                        name: this.form.name,
                        content: this.form.content,
                    }),
                });

                if (!response.ok) throw new Error("Failed to submit");

                const result = await response.json();
                this.successMessage = result.message;
                this.form.name = "";
                this.form.content = "";
                this.fetchComments(); // reload comments
            } catch (err) {
                console.error("Error:", err);
            }
        },
    },
    mounted() {
        this.fetchComments();
    },
};
</script>
