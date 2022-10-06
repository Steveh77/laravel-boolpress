<template>
    <section class="list">
        <h2>Posts</h2>
        <div v-if="posts.length">
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
        <h4 v-else>Nessun Post</h4>
    </section>
</template>
<script>
import PostCard from './PostCard.vue';
export default {
    name: "PostList",
    data() {
        return {
            posts: [],
        };
    },
    methods: {
        fetchPosts() {
            axios.get("http://localhost:8000/api/posts")
                .then((res) => {
                    this.posts = res.data;
                })
                .catch((err) => {
                    console.error(err);
                })
                .then(() => {
                    console.log("chiamata terminata");
                });
        },
    },
    mounted() {
        this.fetchPosts();
    },
    components: { PostCard }
}
</script>