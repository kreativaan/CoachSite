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

            <!-- user can edit comment -->
            <p class="text-gray-700" v-if="editingCommentId !== comment.id">
                {{ comment.content }}
            </p>
            <div v-else class="mt-2">
                <textarea
                    v-model="editingContent"
                    rows="2"
                    class="w-full p-2 border rounded"
                ></textarea>
                <div class="flex gap-2 mt-2">
                    <button
                        @click="updateComment(comment.id)"
                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                    >
                        Save
                    </button>
                    <button
                        @click="cancelEdit"
                        class="bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400"
                    >
                        Cancel
                    </button>
                </div>
            </div>
            <div
                v-if="user && user.id === comment.user_id"
                class="flex gap-2 mt-2"
            >
                <button
                    @click="editComment(comment)"
                    class="text-sm text-blue-600 hover:underline"
                >
                    Edit
                </button>
                <button
                    @click="deleteComment(comment.id)"
                    class="text-sm text-red-600 hover:underline"
                >
                    Delete
                </button>
            </div>

            <!-- Show admin reply if it exists -->
            <div
                v-if="comment.admin_reply"
                class="bg-gray-100 p-2 mt-3 rounded text-sm text-blue-800"
            >
                <div v-if="editingReplyFor !== comment.id">
                    <strong>Admin:</strong> {{ comment.admin_reply }}

                    <!-- Edit/Delete buttons -->
                    <div
                        v-if="user && user.is_admin"
                        class="mt-2 flex gap-2 text-sm"
                    >
                        <button
                            @click="startEditingReply(comment)"
                            class="text-yellow-600 hover:underline"
                        >
                            ✏️ Edit
                        </button>
                        <button
                            @click="deleteReply(comment.id)"
                            class="text-red-600 hover:underline"
                        >
                            🗑️ Delete
                        </button>
                    </div>
                </div>

                <!-- Edit Form -->
                <div v-else>
                    <textarea
                        v-model="adminReplies[comment.id]"
                        rows="2"
                        class="w-full p-2 border rounded"
                    ></textarea>
                    <div class="flex gap-2 mt-2">
                        <button
                            @click="submitReply(comment.id)"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                        >
                            Save
                        </button>
                        <button
                            @click="cancelEdit()"
                            class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Show reply form if admin and no reply yet -->
            <div v-else-if="user && user.is_admin" class="mt-4">
                <div v-if="showReplyFormFor !== comment.id">
                    <a
                        href="#"
                        @click.prevent="showReplyFormFor = comment.id"
                        class="text-blue-600 hover:underline text-sm"
                        >Reply</a
                    >
                </div>
                <div v-else>
                    <textarea
                        v-model="adminReplies[comment.id]"
                        rows="2"
                        class="w-full p-2 border rounded"
                        placeholder="Reply to this comment..."
                    ></textarea>
                    <div class="flex gap-2 mt-2">
                        <button
                            @click="submitReply(comment.id)"
                            class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600"
                        >
                            Submit Reply
                        </button>
                        <button
                            @click="showReplyFormFor = null"
                            class="bg-gray-400 text-white px-4 py-1 rounded hover:bg-gray-500"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div v-if="user">
                <form @submit.prevent="submitComment">
                    <h4 class="text-lg font-medium mb-2">Leave a Comment</h4>

                    <input type="hidden" v-model="form.name" />

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
            <div
                v-else
                class="bg-yellow-100 border border-yellow-300 p-4 rounded"
            >
                <p class="text-yellow-800">
                    You must
                    <a href="/login" class="underline text-blue-600">log in</a>
                    or
                    <a href="/register" class="underline text-blue-600"
                        >register</a
                    >
                    to leave a comment.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import SuccessMessage from "./SuccessMessage.vue";

export default {
    props: ["postId", "user"],
    data() {
        return {
            showReplyFormFor: null,
            editingReplyFor: null,
            comments: [],
            adminReplies: {},
            form: {
                name: "",
                content: "",
            },
            successMessage: "",
            editingCommentId: null,
            editingContent: "",
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
        async submitReply(commentId) {
            try {
                const response = await fetch(
                    `/api/comments/${commentId}/reply`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify({
                            admin_reply: this.adminReplies[commentId],
                        }),
                    }
                );

                if (!response.ok) throw new Error("Failed to reply");

                this.adminReplies[commentId] = ""; // clear the input
                this.editingReplyFor = null;
                await this.fetchComments(); // reload to show new reply
            } catch (err) {
                console.error("Reply failed:", err);
            }
        },
        startEditingReply(comment) {
            this.editingReplyFor = comment.id;
            this.adminReplies[comment.id] = comment.admin_reply;
        },
        cancelEdit() {
            this.editingReplyFor = null;
        },
        async deleteReply(commentId) {
            if (!confirm("Are you sure you want to delete this reply?")) return;

            try {
                const response = await fetch(
                    `/api/comments/${commentId}/reply`,
                    {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    }
                );

                if (!response.ok) throw new Error("Failed to delete reply");

                this.fetchComments(); // refresh comments
            } catch (err) {
                console.error("Delete failed:", err);
            }
        },
        startEditingReply(comment) {
            this.editingReplyFor = comment.id;
            this.adminReplies[comment.id] = comment.admin_reply;
        },
        cancelEdit() {
            this.editingReplyFor = null;
        },
        async deleteReply(commentId) {
            if (!confirm("Are you sure you want to delete this reply?")) return;

            try {
                const response = await fetch(
                    `/api/comments/${commentId}/reply`,
                    {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    }
                );

                if (!response.ok) throw new Error("Failed to delete reply");

                this.fetchComments(); // refresh comments
            } catch (err) {
                console.error("Delete failed:", err);
            }
        },
        editComment(comment) {
            this.editingCommentId = comment.id;
            this.editingContent = comment.content;
        },

        cancelEdit() {
            this.editingCommentId = null;
            this.editingContent = "";
        },

        async updateComment(commentId) {
            try {
                const response = await fetch(`/comments/${commentId}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        content: this.editingContent,
                    }),
                });

                if (!response.ok) throw new Error("Failed to update comment");

                this.editingCommentId = null;
                this.editingContent = "";
                this.fetchComments();
            } catch (err) {
                console.error("Update failed:", err);
            }
        },

        async deleteComment(commentId) {
            if (!confirm("Are you sure you want to delete this comment?"))
                return;

            try {
                const response = await fetch(`/comments/${commentId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                });

                const data = await response.json();

                if (!response.ok) {
                    console.error("Error from server:", data);
                    throw new Error("Failed to delete comment");
                }

                this.fetchComments();
            } catch (err) {
                console.error("Delete failed:", err);
            }
        },
    },
    mounted() {
        if (this.user) {
            this.form.name = this.user.name;
        }
        this.fetchComments();
    },
};
</script>
