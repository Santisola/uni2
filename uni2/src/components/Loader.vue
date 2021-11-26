<template>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
</template>
<script>
export default {
    name: "Loader",
    mounted() {
        document.body.style = 'overflow: hidden;'
    },
    destroyed() {
        document.body.style = ''
    },
}
</script>
<style scoped>
    .loader-container{
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, .5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

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