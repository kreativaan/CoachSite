<template>
    <nav class="bg-blue-500 text-white fixed top-0 w-full z-50">
        <div
            class="max-w-7xl mx-auto px-4 flex items-center justify-between h-14"
        >
            <!-- Left: Logo -->
            <div class="text-xl font-bold">FitCoach</div>

            <!-- Center: Nav Links (desktop only) -->
            <div class="hidden md:flex gap-6 font-semibold text-yellow-50">
                <NavLink href="/" text="Home" />
                <NavLink href="/about" text="About" />
                <NavLink href="/blog" text="Blog" />
                <NavLink href="/contact" text="Contact" />
                <template v-if="user && user.is_admin">
                    <NavLink href="/trainer" text="Edit Trainer" />
                    <NavLink href="/admin/blog" text="Create Post" />
                    <NavLink
                        href="/admin/messages"
                        text="Inbox"
                        :hasDot="hasMessages"
                    />
                    <NavLink href="/dashboard" text="Dashboard" />
                </template>
            </div>

            <!-- Right: Auth Links -->
            <div class="hidden md:flex items-center gap-4 font-semibold">
                <template v-if="!user">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </template>
                <form method="POST" action="/logout" v-if="user">
                    <input type="hidden" name="_token" :value="csrf" />
                    <button class="hover:text-red-500">Logout</button>
                </form>
            </div>

            <!-- Mobile: Hamburger -->
            <button @click="toggleMenu" class="md:hidden focus:outline-none">
                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <transition name="slide">
            <div
                v-if="mobileMenuOpen"
                class="md:hidden bg-blue-500 flex flex-col items-center font-semibold gap-4 pb-6 pt-4"
            >
                <NavLink href="/" text="Home" />
                <NavLink href="/about" text="About" />
                <NavLink href="/blog" text="Blog" />
                <NavLink href="/contact" text="Contact" />
                <template v-if="user && user.is_admin">
                    <NavLink href="/trainer" text="Edit Trainer" />
                    <NavLink href="/admin/blog" text="Create Post" />
                    <NavLink
                        href="/admin/messages"
                        text="Inbox"
                        :hasDot="hasMessages"
                    />
                    <NavLink href="/dashboard" text="Dashboard" />
                </template>
                <template v-if="!user">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </template>
                <form method="POST" action="/logout" v-if="user">
                    <input type="hidden" name="_token" :value="csrf" />
                    <button class="hover:text-red-500">Logout</button>
                </form>
            </div>
        </transition>
    </nav>
</template>

<script>
import NavLink from "./NavLink.vue";
export default {
    components: {
        NavLink,
    },
    data() {
        return {
            mobileMenuOpen: false,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            user: window.authUser || null,
            hasMessages: false,
        };
    },
    methods: {
        toggleMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
        },
    },
    async mounted() {
        if (this.user && this.user.is_admin) {
            try {
                const res = await fetch("/api/messages/count");
                const data = await res.json();
                this.hasMessages = data.count > 0;
            } catch (err) {
                console.error("Message count fetch failed", err);
            }
        }
    },
};
</script>

<!-- Tailwind transition -->
<style>
.slide-enter-active,
.slide-leave-active {
    transition: max-height 0.3s ease-in-out;
}
.slide-enter-from,
.slide-leave-to {
    max-height: 0;
    overflow: hidden;
}
.slide-enter-to,
.slide-leave-from {
    max-height: 500px;
}
</style>
