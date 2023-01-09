<template>
    <div>
        <div class="card draggable shadow-sm">
            <div class="card-body p-2">
                <div class="card-title">
                    <a href="#" @click.prevent="showCardModal = true" class="lead font-weight-light">{{ title }}</a>
                </div>
            </div>
        </div>
        <div class="dropzone rounded"> &nbsp; </div>
        <card-modal :card="updatedCard" v-if="showCardModal" @card-updated="updated" @close-card-modal="showCardModal = false"></card-modal>
    </div>
</template>

<script>
export default {
    props: ['card'],
    data() {
        return {
            showCardModal: false,
            title: this.card.title,
            updatedCard: this.card,
        }
    },
    methods: {
        updated(card) {
            this.title = card.title;
            this.updatedCard = card;
        }
    }
}
</script>

<style scoped>
.drag > div {
    transform: rotate(5deg);
}

.ghost {
    background: gray;
    border-radius: 5px;
}

.ghost > div {
    visibility: hidden;
}
</style>
