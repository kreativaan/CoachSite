<template>
    <nav
        class="bg-blue-500 text-white flex justify-center font-semibold gap-5 py-1.5 fixed top-0 w-full z-50"
    >
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/blog">Blog</a>
        <a href="/contact">Contact</a>
        <!-- if logged in -->
        <a v-if="user && user.is_admin" href="/trainer">Edit trainer</a>
        <a v-if="user && user.is_admin" href="/admin/blog">Create a post</a>

        <div class="relative inline-block">
            <a
                v-if="user && user.is_admin"
                href="/admin/messages"
                class="relative"
            >
                Inbox
                <span
                    v-if="hasMessages"
                    class="bg-red-500 rounded-full h-2 w-2 absolute top-0 right-0 transform translate-x-2.5 -translate-y-1/5"
                ></span>
            </a>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: window.authUser || null,
            hasMessages: false,
        };
    },
    async mounted() {
        if (this.user && this.user.is_admin) {
            try {
                const res = await fetch("/api/messages/count");
                const data = await res.json();
                this.hasMessages = data.count > 0;
            } catch (err) {
                console.error("Failed to fetch message count", err);
            }
        }
    },
};
</script>
