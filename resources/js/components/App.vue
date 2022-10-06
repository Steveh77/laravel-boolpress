<template>
    <div class="content">
        <AppNav :title="title" />
        <main class="container mt-3">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import AppNav from "./AppNav.vue";
export default {
    name: "App",
    data() {
        return {
            title: "Boolpress",
        };
    },
    components: { AppNav }
};
</script>
