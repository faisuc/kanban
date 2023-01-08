<template>
    <div :id="'column-' + column.id" class="col-sm-6 col-md-4 col-xl-3">
        <div class="card bg-light">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h6 class="card-title text-truncate py-2" :class="{ 'd-none': editing }" v-text="title"></h6>
                        <input @keyup.enter="update(column.id)" ref="titleInput" :value="title" type="text" class="form-control mb-1" :class="{ 'd-block': editing, 'd-none': ! editing }" />
                    </div>
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle text-muted arrow-none show" data-bs-toggle="dropdown" aria-expanded="true">
                            <i class="mdi mdi-dots-vertical font-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 27px);">
                            <a @click="editing = true" href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                            <a @click="deleteColumn(column.id)" href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Delete</a>
                        </div>
                    </div>
                </div>
                <div class="items border border-light">
                    <template v-for="card in column.cards" :key="card.id">
                        <column-card :card="card"></column-card>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['column'],
        data() {
            return {
                editing: false,
                title: this.column.title,
            }
        },
        methods: {
            deleteColumn(id) {
                if (confirm("Are you sure?")) {
                    axios.delete('/api/v1/columns/' + id)
                        .then(response => {
                            document.getElementById('column-' + id).remove();
                        });
                }
            },
            update(id) {
                axios.patch('/api/v1/columns/' + id, { title: this.$refs.titleInput.value })
                    .then(response => {
                        this.editing = false;
                        this.title = this.$refs.titleInput.value;
                    });
            }
        }
    }
</script>
