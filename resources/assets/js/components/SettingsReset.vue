<template>
  <button href="#" @click="clicked">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    route: {
      required: true,
      type: String
    }
  },

  data() {
    return {
      loading: false
    };
  },

  methods: {
    clicked() {
      this.confirm(
        "Continue?",
        "This will reset all settings to defaults!",
        "is-danger",
        this.reset
      );
    },

    reset() {
      this.loading = true;

      axios
        .delete(this.route)
        .then(() => {
          this.loading = false;
          location.reload();
        })
        .catch(error => {
          this.loading = false;
          flash("An error occurred!", "is-danger");
        });
    }
  }
};
</script>
