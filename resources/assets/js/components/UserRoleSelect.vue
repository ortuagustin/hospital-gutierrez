<template>
  <div>
    <p class="title is-5 has-text-grey">Add/Remove Roles:</p>
    <v-select multiple v-model="selected" :options="roles" label="name" @input="changed"></v-select>
  </div>
</template>

<script>
import Vue from "vue";
import vSelect from "vue-select";

export default {
  props: ["user", "roles"],

  components: { vSelect },

  data() {
    return {
      selected: "",
      initializing: true
    };
  },

  created() {
    this.selected = this.user.roles;
  },

  methods: {
    changed(values) {
      if (this.initializing) {
        this.initializing = false;
        return;
      }

      axios
        .patch(this.url(), this.selected_roles())
        .then(() => flash("Updated User roles"));
    },

    selected_roles() {
      return {
        roles: this.selected.map(each => each.id)
      };
    },

    url() {
      return `/user/${this.user.id}/roles`;
    }
  }
};
</script>
