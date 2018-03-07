<template>
<button class="button has-text-danger is-white" :class="loading ? 'is-loading' : ''" :disabled="loading" @click="clicked">
    <span class="icon">
        <i class="fas fa-trash-alt fa-2x"></i>
    </span>

    <span>
      <slot></slot>
    </span>
</button>
</template>

<script>
export default {
  props: {
    route: {
      required: true,
      type: String
    },

    title: {
      required: false,
      type: String,
      default: "Continue?"
    },

    message: {
      required: false,
      type: String,
      default: "This will delete the record"
    }
  },

  data() {
    return {
      loading: false
    };
  },

  methods: {
    clicked() {
      this.confirm(this.title, this.message, "is-danger", this.delete);
    },

    delete() {
      this.loading = true;

      axios
        .delete(this.route)
        .then(() => {
          this.loading = false;
          this.$emit("deleted");
        })
        .catch(error => {
          this.loading = false;
          this.$emit("failed", error);
        });
    }
  }
};
</script>
