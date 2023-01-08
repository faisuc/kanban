<template>
    <h3>Boards</h3>
    <div class="row">
        <div v-for="board in boards" :key="board.id" class="col-sm-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ board.title }}</h5>
                    <a :href="route('user.boards.show', board.id)" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
        }
    }
}
</script>