<template>
    <nav
        class="bg-blue-500 text-white flex justify-center font-semibold gap-5 py-1.5 fixed top-0 w-full"
    >
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/blog">Blog</a>
        <a href="/contact">Contact</a>
        <!-- if logged in -->
        <a v-if="user && user.is_admin" href="/trainer">Edit trainer</a>
        <a v-if="user && user.is_admin" href="/admin/blog">Create a post</a>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: window.authUser || null,
        };
    },
};
</script>
