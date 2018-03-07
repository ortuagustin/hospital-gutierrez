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
    removesParentOnDelete: {
      required: false,
      type: Boolean,
      default: false
    },

    flashesOnDelete: {
      required: false,
      type: Boolean,
      default: true
    },

    flashMessage: {
      required: false,
      type: String,
      default: "Deleted!"
    },

    route: {
      required: true,
      type: String
    },

    promptTitle: {
      required: false,
      type: String,
      default: "Continue?"
    },

    promptMessage: {
      required: false,
      type: String,
      default: "This will delete the record"
    },

    promptType: {
      required: false,
      type: String,
      default: "is-danger"
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
        this.promptTitle,
        this.promptMessage,
        this.promptType,
        this.delete
      );
    },

    delete() {
      this.loading = true;

      axios
        .delete(this.route)
        .then(() => {
          this.deleted();
        })
        .catch(error => {
          this.loading = false;
        });
    },

    deleted() {
      this.loading = false;

      if (this.flashesOnDelete) {
        flash(this.flashMessage);
      }

      if (this.removesParentOnDelete) {
        $(this.$parent.$el).fadeOut();
      }
    }
  }
};
</script>
