<template>
    <div>
        <div class="card draggable shadow-sm">
            <div class="card-body p-2">
                <div class="card-title">
                    <a href="" class="lead font-weight-light">{{  card.title }}</a>
                </div>
            </div>
        </div>
        <div class="dropzone rounded"> &nbsp; </div>
    </div>
</template>

<script>
    export default {
        props: ['card'],
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
