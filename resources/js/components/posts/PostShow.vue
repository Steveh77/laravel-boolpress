<template>
    <div>
        <h1>Post details</h1>
        <PostCard :post="post" />
    </div>
</template>

<script>
import PostCard from './PostCard.vue';
export default {
    name: "PostShow",
    data() {
        return {
            post: null
        };
    },
    methods: {
        fetchPost() {
            axios.get("http://localhost:8000/api/posts/" + this.$route.params.id)
                .then(res => {
                    this.post = res.data;
                }).catch(err => {
                    console.log(err);
                }).then(() => {
                    console.log("chiamata terminata");
                });
        }
    },
    mounted() {
        this.fetchPost();
    },
    components: { PostCard }
}
</script>