<template>
    <transition name="fade">
        <p
            v-if="visible"
            class="text-white bg-green-400 rounded-xl font-semibold px-3 py-2 mt-3"
        >
            {{ message }}
        </p>
    </transition>
</template>

<script>
export default {
    props: ["message"],
    data() {
        return {
            visible: false,
        };
    },
    watch: {
        message(newVal) {
            if (newVal) {
                this.visible = true;
                setTimeout(() => {
                    this.visible = false;
                }, 3600); //
            }
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
