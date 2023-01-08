<template>
    <div>
        Board Index
    </div>
</template>

<script>
export default {
    inject: ['loggedInUserID'],
    created() {
        this.fetchBoards();
    },
    methods: {
        fetchBoards() {
            fetch('/api/v1/user/' + this.loggedInUserID + '/boards')
                .then(res => {
                    console.log(res.data);
                });
        }
    }
}
</script>