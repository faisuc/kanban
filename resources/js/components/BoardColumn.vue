<template>
    <div class="col-sm-6 col-md-4 col-xl-3">
        <div class="card bg-light">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h6 class="card-title text-uppercase text-truncate py-2">{{ column.title }}</h6>
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle text-muted arrow-none show" data-bs-toggle="dropdown" aria-expanded="true">
                            <i class="mdi mdi-dots-vertical font-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 27px);">
                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Delete</a>
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
import ColumnCard from './ColumnCard.vue'
    export default {
  components: { ColumnCard },
        props: ['column'],
    }
</script>
