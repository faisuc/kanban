<template>
    <div>
        <div class="card draggable shadow-sm">
            <div class="card-body p-2">
                <div class="card-title">
                    <a href="" class="lead font-weight-light">{{  card.title }}</a>
                </div>
                <p>
                    {{ card.description }}
                </p>
                <button class="btn btn-primary btn-sm">View</button>
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
