<template>
    <form @submit.prevent="create">
        <div class="form-group">
            <input v-model="title" type="text" class="form-control" placeholder="Title">
        </div>
        <div class="form-group mt-1">
            <textarea v-model="description" class="form-control" placeholder="Description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-1">CREATE CARD</button>
    </form>
</template>

<script>
import axios from 'axios'
    export default {
        props: ['columnId'],
        data() {
            return {
                title: null,
                description: null,
            }
        },
        methods: {
            create() {
                axios.post('/api/v1/cards', { column_id: this.columnId, title: this.title, description: this.description } )
                    .then(response => {
                        this.$emit('card-added', response.data.data);
                        this.title = null;
                        this.description = null;
                    });
            }
        }
    }
</script>
