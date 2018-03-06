<template>
<div class="columns is-2">
  <div class="column is-one-fifth">
    <label class="input-label label is-capitalized"> {{ setting.human_name }} </label>
  </div>

  <div class="column">
      <div class="field is-grouped">
        <p class="control is-expanded">
          <label class="checkbox">
            <input ref="input" name="key" type="checkbox" v-model="checked" @change="changed" :disabled="loading">

            <slot></slot>
          </label>
          <span v-if="feedback" v-text="feedback" class="help has-text-weight-bold has-text-danger"></span>
        </p>
      </div>
  </div>
</div>
</template>

<script>
import SettingInput from "./SettingInput.vue";

export default {
  extends: SettingInput,

  mounted() {
    this.$refs.input.checked = this.setting.value == "1";
  },

  methods: {
    checked() {
      return this.form.value ? "1" : "0";
    },

    changed(event) {
      this.form.value = event.target.checked ? "1" : "0";
      this.submit();
    }
  }
};
</script>

