<template>
    <div>
        <button class="btn btn-primary" style="width:5rem; height:2rem; padding-top:2.5px" @click="followUser">Follow</button>
    </div>
</template>

<script>
    export default {
        props: ['user_id'],

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            followUser() {
                axios.post('/follow/1')
                .then(response => {
                    console.log(response);
                });
            }
        }
    }
</script>
