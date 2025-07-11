<template>
    <div class="bg-white py-10 px-6 max-w-2xl rounded-xl mx-auto mt-16 shadow">
        <form @submit.prevent="submitForm" class="space-y-6">
            <h2 class="text-2xl font-bold mb-4 text-center">Trainer Profile</h2>

            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input
                    type="text"
                    v-model="form.name"
                    class="w-full border rounded-lg px-4 py-2 bg-gray-100"
                />
            </div>

            <div v-if="form.profile_photo">
                <p class="font-semibold mb-2">Current Profile Photo:</p>
                <img
                    :src="`/uploads/${form.profile_photo}`"
                    class="w-48 rounded-lg shadow mb-4"
                />
            </div>

            <div>
                <label class="block font-semibold mb-1">Profile Photo</label>
                <input type="file" @change="handleFileUpload" />
            </div>

            <div>
                <label class="block font-semibold mb-1">Bio</label>
                <textarea
                    v-model="form.bio"
                    class="w-full border rounded-lg px-4 py-2 bg-gray-100 min-h-[120px]"
                ></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Specialty</label>
                <input
                    type="text"
                    v-model="form.specialty"
                    class="w-full border rounded-lg px-4 py-2 bg-gray-100"
                />
            </div>

            <div>
                <label class="block font-semibold mb-1"
                    >Years of Experience</label
                >
                <input
                    type="number"
                    v-model="form.years_experience"
                    class="w-full border rounded-lg px-4 py-2 bg-gray-100"
                />
            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg"
            >
                Save Profile
            </button>

            <SuccessMessage :message="successMessage" />
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
                bio: "",
                specialty: "",
                years_experience: 0,
                profile_photo: "", // ✅ make sure this exists from the start
            },
            profilePhotoFile: null,
            successMessage: "",
        };
    },
    components: {
        SuccessMessage,
    },
    methods: {
        handleFileUpload(event) {
            this.profilePhotoFile = event.target.files[0];
        },

        async submitForm() {
            try {
                const formData = new FormData();
                for (let key in this.form) {
                    formData.append(key, this.form[key]);
                }

                if (this.profilePhotoFile) {
                    formData.append("profile_photo", this.profilePhotoFile);
                } else if (this.form.profile_photo) {
                    formData.append("existing_photo", this.form.profile_photo);
                }

                const response = await fetch("/trainer-profile", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: formData,
                });

                if (!response.ok) throw new Error("Failed to submit form");

                const data = await response.json();
                this.successMessage = data.message;
                this.getTrainer();
            } catch (error) {
                console.error(error);
            }
        },

        async getTrainer() {
            try {
                const response = await fetch("api/trainer");
                const data = await response.json();

                // ✅ assign fields one-by-one to preserve reactivity
                this.form.name = data.name || "";
                this.form.bio = data.bio || "";
                this.form.specialty = data.specialty || "";
                this.form.years_experience = data.years_experience || 0;
                this.form.profile_photo = data.profile_photo || "";
            } catch (error) {
                console.error("Failed to fetch trainer data", error);
            }
        },
    },
    mounted() {
        this.getTrainer();
    },
};
</script>
