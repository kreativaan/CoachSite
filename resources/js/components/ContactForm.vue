<template>
    <div
        class="bg-white flex justify-center items-center max-w-2xl rounded-2xl mx-auto shadow-md mt-16"
    >
        <form @submit.prevent="submitForm">
            <h2 class="mt-5">Contact me</h2>
            <div>
                <label>Your name </label>
                <input type="text" v-model="form.name" required />
            </div>

            <div>
                <label>Your email address </label>
                <input type="email" v-model="form.email" required />
            </div>
            <div>
                <label>Your message </label>
                <textarea v-model="form.message" required></textarea>
            </div>
            <button class="mb-8" type="submit">Send</button>
            <div class="pb-10">
                <SuccessMessage :message="successMessage" />
            </div>
        </form>
    </div>
</template>

<script>
import SuccessMessage from "./SuccessMessage.vue";
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                message: "",
            },
            successMessage: "",
        };
    },
    components: {
        SuccessMessage,
    },
    methods: {
        async submitForm() {
            try {
                const response = await fetch("/contact", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify(this.form),
                });

                if (!response.ok) {
                    throw new Error("Something went wrong");
                }

                const data = await response.json();
                this.successMessage = data.message;
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<style scoped>
.form-container {
    display: flex;

    padding: 2rem;
    justify-content: center;
    margin: auto;
}

h2 {
    font-weight: bold;
}

label {
    margin: 10px 0;
    display: block;
    font-weight: 600;
}

input,
textarea {
    display: block;
    margin-bottom: 20px;
    padding: 10px;
    width: 300px;
    background-color: rgb(238, 236, 236);
    border-radius: 10px;
}
button {
    background-color: #3b82f6;
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
}
</style>
