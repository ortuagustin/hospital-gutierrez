<template>
  <div>
      <div class="field">
          <p class="control">
              <vue-report-select :endpoint="endpoint" @input="changed"></vue-report-select>
          </p>

          <hr>
      </div>

      <div>
          <vue-line-chart v-if="selected" :endpoint="selected"></vue-line-chart>
      </div>
  </div>
</template>

<script>
export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      selected: ""
    };
  },

  methods: {
    changed(value) {
      this.selected = value;
    }
  }
};
</script>
