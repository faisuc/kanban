<template>
    <div class="d-flex flex-row justify-content-between">
        <h3>Board</h3>
        <input class="btn btn-dark" @click="dumpSQL" type="button" value="DUMP DATABASE">
        <board-create @board-added="addBoard"></board-create>
    </div>
    <div class="row">
        <div v-for="board in boards" :key="board.id" class="col-sm-3 p-2">
            <div :id="'board-' + board.id" class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ board.title }}</h5>
                    <a :href="route('user.boards.show', board.id)" class="btn btn-primary" style="margin-right: 10px;">View</a>
                    <a @click.prevent="deleteBoard(board.id)" href="#" class="btn btn-secondary">Delete</a>
                </div>
            </div>
        </div>
        <template v-if="boards.length == 0">
            <p>No boards created</p>
        </template>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    inject: ['loggedInUserID'],
    data() {
        return {
            boards: [],
        }
    },
    created() {
        this.fetchBoards();
    },
    methods: {
        fetchBoards() {
            axios.get('/api/v1/user/' + this.loggedInUserID + '/boards')
                .then(response => {
                    this.boards = response.data.data;
                });
        },
        addBoard(board) {
            this.boards.push(board);
        },
        deleteBoard(id) {
            if (confirm("Are you sure?")) {
                axios.delete('/api/v1/boards/' + id)
                    .then(response => {
                        this.fetchBoards();
                    });
            }
        },
        dumpSQL() {
            axios.post('/api/v1/db-dump')
                .then(response => {
                    alert(response.data.meta_data.message);
                });
        }
    }
}
</script>