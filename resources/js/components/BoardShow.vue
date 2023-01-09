<template>
    <div class="d-flex flex-row justify-content-between">
        <h3>Board: {{  boardTitle }}</h3>
        <board-column-create @column-added="addColumn" :board-id="this.boardId"></board-column-create>
    </div>
    <div class="row flex-row flex-sm-nowrap py-3 board-columns-container">
        <!-- Start of columns -->
        <template v-for="column in columns" :key="column.id">
            <board-column :column="column"></board-column>
        </template>
    </div>
    <template v-if="columns.length == 0">
        <p>No columns created</p>
    </template>
</template>

<script>
import axios from 'axios';

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
        },
        addColumn(column) {
            this.columns.push({
                board_id: column.board_id,
                id: column.id,
                owner_id: column.owner_id,
                title: column.title,
                created_at: column.created_at,
                updated_at: column.updated_at,
            });
        }
    }
}
</script>