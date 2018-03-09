<template>
<div class="columns is-2">
  <div class="column is-one-fifth">
    <label class="input-label label is-capitalized"> {{ setting.human_name }} </label>
  </div>

  <div class="column">
    <div class="field">
        <b-switch v-model="form.value" true-value="1" false-value="0" @input="changed">
          <slot></slot>
        </b-switch>
    </div>

    <span v-if="feedback" v-text="feedback" class="help has-text-weight-bold has-text-danger"></span>
  </div>
</div>
</template>

<script>
import SettingInput from "./SettingInput.vue";

export default {
  extends: SettingInput,

  methods: {
    changed(event) {
      if (this.setting.value !== this.form.value) {
        this.submit();
      }
    }
  }
};
</script>

