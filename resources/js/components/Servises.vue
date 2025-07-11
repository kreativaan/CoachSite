<template>
    <section class="max-w-5xl mx-auto px-6 mt-16">
        <h2 class="text-3xl font-bold text-center mb-10">My Services</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div
                v-for="service in services"
                :key="service.id"
                class="bg-white p-6 rounded-2xl shadow hover:shadow-lg hover:scale-105 transition cursor-pointer"
            >
                <a :href="`/services/${service.slug}`">
                    <div class="flex items-center gap-3 mb-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-10 h-10 align-middle overflow-visible"
                            :class="service.iconColor"
                        >
                            <path
                                v-for="(d, i) in normalizeIconPath(
                                    service.iconPath
                                )"
                                :key="i"
                                :d="d"
                            />
                        </svg>
                        <h3 class="text-xl font-semibold">
                            {{ service.title }}
                        </h3>
                    </div>
                    <p class="text-gray-600">{{ service.short }}</p>
                </a>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    methods: {
        // Normalize iconPath to always return an array (for v-for)
        normalizeIconPath(path) {
            return Array.isArray(path) ? path : [path];
        },
    },
    data() {
        return {
            services: [
                {
                    id: 1,
                    slug: "personal-training",
                    title: "1-on-1 Personal Training",
                    short: "Tailored workouts and coaching for individual goals.",
                    iconPath: [
                        "M17.596 12.768a2 2 0 1 0 2.829-2.829l-1.768-1.767a2 2 0 0 0 2.828-2.829l-2.828-2.828a2 2 0 0 0-2.829 2.828l-1.767-1.768a2 2 0 1 0-2.829 2.829z",
                        "M5.343 21.485a2 2 0 1 0 2.829-2.828l1.767 1.768a2 2 0 1 0 2.829-2.829l-6.364-6.364a2 2 0 1 0-2.829 2.829l1.768 1.767a2 2 0 0 0-2.828 2.829z",
                        "m2.5 21.5 1.4-1.4",
                        "m20.1 3.9 1.4-1.4",
                        "m9.6 14.4 4.8-4.8",
                    ],
                    iconColor: "text-blue-600",
                },
                {
                    id: 2,
                    slug: "group-training",
                    title: "Group Training",
                    short: "Energetic group classes that motivate and inspire.",
                    iconPath: [
                        "M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2",
                        "M9 7a4 4 0 100-8 4 4 0 000 8z",
                        "M23 21v-2a4 4 0 00-3-3.87",
                        "M16 3.13a4 4 0 010 7.75",
                    ],
                    iconColor: "text-green-600",
                },
                {
                    id: 3,
                    slug: "online-coaching",
                    title: "Online Coaching",
                    short: "Remote fitness plans with weekly check-ins.",
                    iconPath: [
                        "M3 4a1 1 0 011-1h16a1 1 0 011 1v13a1 1 0 01-1 1H6l-4 4V4z",
                        "M8 10h8M8 6h8M8 14h4",
                    ],
                    iconColor: "text-purple-600",
                },
            ],
        };
    },
};
</script>

<style scoped>
a {
    display: block;
}
</style>
