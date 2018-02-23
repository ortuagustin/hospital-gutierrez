<template>
<transition name="bounce">
  <div class="modal is-active" v-if="visible">
    <div class="modal-background" @click="hide"></div>
    <div class="modal-content box">
      <slot></slot>
    </div>
  </div>
</transition>

</template>

<script>
export default {
  data() {
    return {
      visible: false
    };
  },

  methods: {
    hide() {
      this.visible = false;
    },

    show() {
      this.visible = true;
    }
  },

  mounted: function() {
    document.addEventListener("keydown", e => {
      if (this.visible && e.keyCode == 27) {
        this.hide();
      }
    });
  }
};
</script>

<style>
.bounce-enter-active {
  animation: bounce-in 0.5s;
}

.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
</style>
