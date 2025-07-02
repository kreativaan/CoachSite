<template>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg mt-16">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form @submit.prevent="submitForm">
            <label class="block mb-2 font-semibold">Title</label>
            <input
                type="text"
                v-model="form.title"
                class="w-full p-2 mb-4 border rounded"
            />

            <label class="block mb-2 font-semibold">Content</label>
            <textarea
                v-model="form.content"
                class="w-full p-2 mb-4 border rounded min-h-40"
            ></textarea>

            <label class="block mb-2 font-semibold"
                >Replace Image (optional)</label
            >
            <input
                type="file"
                @change="handleFileUpload"
                class="mb-4 block border rounded p-2"
            />

            <button
                type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded"
            >
                Update
            </button>

            <p v-if="successMessage" class="text-green-600 mt-4">
                {{ successMessage }}
            </p>
        </form>
    </div>
</template>

<script>
export default {
    props: ["id"],
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
        async fetchPost() {
            const res = await fetch(`/api/posts/${this.id}`);
            const data = await res.json();
            this.form.title = data.title;
            this.form.content = data.content;
        },
        handleFileUpload(e) {
            this.imageFile = e.target.files[0];
        },
        async submitForm() {
            const formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("content", this.form.content);
            if (this.imageFile) {
                formData.append("image", this.imageFile);
            }

            const res = await fetch(`/api/posts/${this.id}`, {
                method: "POST", // Laravel expects POST + _method override
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: (() => {
                    formData.append("_method", "PUT"); // Laravel trick to simulate PUT
                    return formData;
                })(),
            });

            const result = await res.json();
            this.successMessage = result.message;
        },
    },
    mounted() {
        this.fetchPost();
    },
};
</script>
