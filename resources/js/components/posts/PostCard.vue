<template>
    <div>
        <div class="card my-2 d-flex flex-row align-items-center">
            <div class="card-body">
                <h5 class="card-title">{{post.title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Publicato il: {{publishedAt}}</h6>
                <p class="card-text">{{post.content}}</p>
            </div>
            <router-link :to="{name: 'post-show', params:{ id: post.id } }" class="btn btn-success mr-2">Vedi
            </router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: 'PostCard',
    props: {
        post: Object,
    },
    computed: {
        publishedAt() {
            const postDate = new Date(this.post.created_at);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            let year = postDate.getFullYear();
            if (day < 10) {
                day = '0' + day

            }
            if (month < 10) {
                month = '0' + month

            }
            return `${day}/${month}/${year}`
        }
    }


}
</script>