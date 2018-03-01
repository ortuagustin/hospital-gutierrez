<template>
  <div>
    <p class="title is-5 has-text-grey">Add/Remove Roles:</p>
    <v-select multiple v-model="selected" :options="roles" label="name" @input="changed"></v-select>
  </div>
</template>

<script>
import Vue from 'vue';
import vSelect from 'vue-select';
import axios from "axios";

export default {
  props: ['user', 'roles'],

  components: { vSelect },

  data() {
    return {
      selected: '',
      initializing: true
    }
  },

  created() {
    this.selected = this.user.roles;
  },

  methods: {
    selected_roles()  {
      return {
        roles: this.selected.map(each => each.id)
      }
    },

    changed(values) {

      if (this.initializing) {
        this.initializing = false;
        return;
      }

      axios.patch(`/user/${this.user.id}/roles`, this.selected_roles())
          .then(function(response) {
              console.log(response);
          }.bind(this)
      );
    }
  }
}
</script>
