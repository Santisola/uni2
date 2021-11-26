<template>
    <div class="loader" :style="color ? color : null"></div>
</template>
<script>
export default {
    name: "MiniLoader",
    props: {
        color: String,
    }
}
</script>
<style>
    .loader{
        width: 48px;
        height: 48px;
        display: inline-block;
        border: solid 4px rgba(0, 0, 0, .1);
        border-radius: 50%;
        border-left-color: var(--primary);
        animation: spin 1.5s infinite cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    @keyframes spin {
        0%{
            transform: rotate(0deg);
        }

        100%{
            transform: rotate(360deg);
        }
    }
</style>