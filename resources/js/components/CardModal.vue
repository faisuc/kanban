<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <form @submit.prevent="update">
                      <div class="form-group">
                          <label>Title</label>
                          <input v-model="title" type="text" class="form-control" placeholder="Title">
                      </div>
                      <div class="form-group">
                          <label>Description</label>
                          <textarea v-model="description" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-secondary mr-5" @click="$emit('close-card-modal')">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['card'],
        data() {
          return {
            title: this.card.title,
            description: this.card.description,
          }
        },
        methods: {
          update() {
            axios.patch('/api/v1/cards/' + this.card.id, { title: this.title, description: this.description })
                .then(response => {
                  this.$emit('card-updated', response.data.data);
                  this.$emit('close-card-modal');
                });
          }
        }
    }
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 500px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>