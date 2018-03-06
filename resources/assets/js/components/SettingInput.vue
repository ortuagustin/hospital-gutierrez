<template>
<div class="columns is-2">
  <div class="column is-one-fifth">
    <label class="input-label label is-capitalized"> {{ setting.human_name }} </label>
  </div>

  <div class="column">
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" name="key" :type="setting.type" v-model="form.value" @keydown.enter="submit">
          <span v-if="feedback" v-text="feedback" class="help has-text-weight-bold has-text-danger"></span>
        </p>

        <span class="button is-info" @click="submit" :class="loading ? 'is-loading' : ''" :disabled="loading"> Apply </span>
      </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    setting: {
      required: true,
      type: Object
    },

    route: {
      required: true,
      type: String
    }
  },

  data() {
    return {
      form: {
        key: "",
        value: ""
      },

      feedback: "",
      loading: false
    };
  },

  mounted() {
    this.form.key = this.setting.key;
    this.form.value = this.setting.value;
  },

  methods: {
    submit() {
      this.loading = true;

      axios
        .post(this.route, this.form)
        .then(() => {
          this.loading = false;
          this.reload();
        })
        .catch(error => {
          this.loading = false;
          this.feedback = error.response.data["value"][0];
        });
    },

    reload() {
      if (this.setting.reloads) {
        location.reload();
      }
    }
  }
};
</script>

<style>
.input-label {
  margin: 0.25rem;
}
</style>
