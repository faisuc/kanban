<template>
    <form class="form-inline" @submit.prevent="create">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" v-model="title" class="form-control" placeholder="Add new column">
        </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    props: ['boardId'],
    data() {
        return {
            title: null,
        }
    },
    methods: {
        create() {
            axios.post('/api/v1/columns', { board_id: this.boardId, title: this.title })
                .then(response => {
                    this.$emit('column-added', response.data.data);
                    this.title = null;
                });
        }
    }
}
</script>
