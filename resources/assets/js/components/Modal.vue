<template>
  <div class="modal is-active" v-if="visible">
    <div class="modal-background" @click="hide"></div>
    <div class="modal-content box">
      <slot></slot>
    </div>
  </div>
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
