<!-- components/NavLink.vue -->

<template>
    <a
        :href="href"
        class="relative"
        :class="{
            'text-yellow-100': href === currentPath,
            'hover:text-yellow-300': href !== currentPath,
        }"
    >
        {{ text }}
        <span
            v-if="hasDot"
            class="bg-red-500 absolute top-0 -right-2 h-2 w-2 rounded-full"
        ></span>
    </a>
</template>

<script setup>
defineProps(["href", "text", "hasDot"]);
const currentPath = window.location.pathname;
</script>
