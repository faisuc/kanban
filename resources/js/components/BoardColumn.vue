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
                    <draggable
                        v-model="column.cards"
                        group="cards"
                        @change="onChange"
                        item-key="id"
                        drag-class="drag"
                        ghost-class="ghost"
                    >
                        <template #item="{element}">
                            <column-card :id="'card-container-' + element.id" @card-deleted="cardDeleted" :card="element"></column-card>
                        </template>
                    </draggable>
                    <card-create @card-added="addCard" :column-id="column.id"></card-create>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
    props: ['column'],
    components: {
        draggable,
    },
    data() {
        return {
            editing: false,
            title: this.column.title,
        }
    },
    created() {
        if (this.column.cards === undefined) {
            this.column.cards = [];
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
        addCard(card) {

            this.column.cards.push({
                column_id: card.column_id,
                id: card.id,
                owner_id: card.owner_id,
                title: card.title,
                position: card.position,
                description: card.description,
                created_at: card.created_at,
                updated_at: card.updated_at
            });
        },
        update(id) {
            axios.patch('/api/v1/columns/' + id, { title: this.$refs.titleInput.value })
                .then(response => {
                    this.editing = false;
                    this.title = this.$refs.titleInput.value;
                });
        },
        onChange(e) {
            let item = e.added || e.moved;

            if (! item) return;

            let index = item.newIndex;
            let prevCard = this.column.cards[index - 1];
            let nextCard = this.column.cards[index + 1];
            let card = this.column.cards[index];
            let position = card.position;

            if (prevCard && nextCard) {
                position = (prevCard.position + nextCard.position) / 2;
            } else if (prevCard) {
                position = prevCard.position + (prevCard.position / 2);
            } else if (nextCard) {
                position = nextCard.position / 2;
            }

            axios.patch('/api/v1/cards/' + card.id + '/move', { column_id: this.column.id, position: position})
                .then(response => {
                    console.log(response);
                });
        },
        cardDeleted(card) {
            document.getElementById('card-container-' + card.id).remove();
        }
    }
}
</script>
