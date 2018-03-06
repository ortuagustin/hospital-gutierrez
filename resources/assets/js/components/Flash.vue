<template>

</template>

<script>
export default {
  props: {
    dataMessage: {
      type: String,
      default: ""
    },

    dataType: {
      type: String,
      default: "is-success"
    }
  },

  data() {
    return {
      message: this.dataMessage,
      type: this.dataType
    };
  },

  mounted() {
    if (this.message) {
      this.flash(this);
    }

    window.events.$on("flash", data => this.flash(data));
  },

  methods: {
    flash(data) {
      this.$toast.open({
        message: data.message,
        type: data.type || "is-success",
        queue: false
      });

      this.message = "";
      this.type = "";
    }
  }
};
</script>