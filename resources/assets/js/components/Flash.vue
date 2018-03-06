<template>
<div class="flash notification" :class="kind" v-if="visible">
  <button class="delete" @click="visible = false"></button>

  <span v-text="body"></span>
</div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      default: ""
    },

    type: {
      type: String,
      default: "is-success"
    }
  },

  computed: {
    kind: () => {
      return this.type || "is-success";
    }
  },

  data() {
    return {
      body: this.message,
      visible: false
    };
  },

  created() {
    if (this.message) {
      this.flash();
    }

    window.events.$on("flash", data => this.flash(data));
  },

  methods: {
    flash(data) {
      if (data) {
        this.body = data.message;
        this.type = data.type;
      }

      this.visible = true;
      this.hide();
    },

    hide() {
      setTimeout(() => {
        this.visible = false;
      }, 3000);
    }
  }
};
</script>

<style>
.flash {
  position: fixed;
  right: 25px;
  bottom: 25px;
}
</style>