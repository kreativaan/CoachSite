<template>
    <div>
        <h2>This is a Vue component!</h2>
        <button @click="count++">Clicked {{ count }} times</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0,
        };
    },
};
</script>

<style scoped>
button {
    background-color: #3b82f6;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
}
</style>
