<template>
    <div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Create Blog Post</h2>
        <form @submit.prevent="submitPost">
            <div class="mb-4">
                <label class="block font-semibold mb-1">Title</label>
                <input
                    type="text"
                    v-model="form.title"
                    class="w-full p-2 border rounded"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Content</label>
                <textarea
                    v-model="form.content"
                    class="w-full p-2 border rounded h-40"
                    required
                ></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Image (optional)</label>
                <input type="file" @change="handleFileUpload" />
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                Save Post
            </button>

            <p v-if="successMessage" class="text-green-600 mt-3">
                {{ successMessage }}
            </p>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: "",
                content: "",
            },
            imageFile: null,
            successMessage: "",
        };
    },
    methods: {
        handleFileUpload(event) {
            this.imageFile = event.target.files[0];
        },

        async submitPost() {
            try {
                const formData = new FormData();
                formData.append("title", this.form.title);
                formData.append("content", this.form.content);
                if (this.imageFile) {
                    formData.append("image", this.imageFile);
                }

                const response = await fetch("/posts", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error("Post submission failed");
                }

                const data = await response.json();
                this.successMessage = data.message;

                // Clear form
                this.form.title = "";
                this.form.content = "";
                this.imageFile = null;
            } catch (error) {
                console.error("Submit failed:", error);
            }
        },
    },
};
</script>
