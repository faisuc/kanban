<template>
    {{ boardId }}
</template>

<script>
export default {
    props: ['boardId'],
    data() {
        return {
            columns: [],
        }
    },
    created() {
        this.fetchColumns();
    },
    methods: {
        fetchColumns() {
            axios.get('/api/v1/boards/' + this.boardId)
                .then(response => {
                    this.columns = response.data.data;
                    console.log(response.data);
                });
        }
    }
}
</script>