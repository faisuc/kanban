<template>
    <h3>Board: {{  boardTitle }}</h3>
    <div class="row flex-row flex-sm-nowrap py-3">
        <!-- Start of columns -->
        <template v-for="column in columns" :key="column.id">
            <board-column :column="column"></board-column>
        </template>
    </div>
</template>

<script>
export default {
    props: ['boardId'],
    data() {
        return {
            columns: [],
            boardTitle: null,
        }
    },
    created() {
        this.fetchColumns();
    },
    methods: {
        fetchColumns() {
            axios.get('/api/v1/boards/' + this.boardId)
                .then(response => {
                    this.columns = response.data.data.columns;
                    this.boardTitle = response.data.data.title;
                });
        }
    }
}
</script>