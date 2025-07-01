<template>
    <div
        class="bg-white py-8 max-w-2xl rounded-xl flex justify-center mx-auto mt-8 mb-20 shadow-md"
    >
        <form @submit.prevent="submitForm">
            <h2>Trainer Profile</h2>
            <div>
                <label>Name:</label>
                <input type="text" v-model="form.name" />
            </div>

            <div v-if="form.profile_photo">
                <h4 class="font-semibold mb-2">Current Profile Photo:</h4>
                <img
                    class="w-48 rounded-lg shadow-lg"
                    :src="`/uploads/${form.profile_photo}`"
                />
            </div>

            <div>
                <label>Profile photo:</label>
                <input type="file" @change="handleFileUpload" />
            </div>

            <div>
                <label>Bio:</label>
                <textarea v-model="form.bio"></textarea>
            </div>
            <div>
                <label>Specialty:</label>
                <input type="text" v-model="form.specialty" />
            </div>

            <div>
                <label>Years Experience:</label>
                <input type="number" v-model="form.years_experience" />
            </div>

            <button type="submit">Save Profile</button>
            <p v-if="successMessage" style="color: green">
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
                name: "",
                bio: "",
                specialty: "",
                years_experience: 0,
            },
            successMessage: "",
        };
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

                if (!response.ok) {
                    throw new Error("Failed to submit form");
                }

                const data = await response.json();
                this.successMessage = data.message;
                this.getTrainers();
            } catch (error) {
                console.error(error);
            }
        },
        async getTrainer() {
            try {
                const response = await fetch("/trainer-profile");
                const data = await response.json();

                // Fill the form with existing trainer data
                this.form = {
                    name: data.name || "",
                    bio: data.bio || "",
                    specialty: data.specialty || "",
                    years_experience: data.years_experience || 0,
                    profile_photo: data.profile_photo || "",
                };
            } catch (error) {
                console.error("Failed to fetch trainer data", error);
            }
        },
    },
    mounted() {
        this.getTrainer(); // Load the profile when page opens
    },
};
</script>

<style scoped>
h2 {
    font-weight: bold;
}

label {
    margin: 10px 0;
    display: block;
    font-weight: 600;
}
textarea {
    min-height: 150px;
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
    padding: 10px;
    border-radius: 6px;
}
</style>
