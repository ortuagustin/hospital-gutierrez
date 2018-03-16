<template>
  <div class="container">
    <p class="title" v-if="title" v-text="title"> </p>
    <line-chart :endpoint="endpoint" :width="width" :height="height"></line-chart>
  </div>
</template>

<script>
import LineChart from "../charts/LineChartImpl.js";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    },

    title: {
      type: String,
      default: ""
    },

    height: {
      type: Number,
      required: false,
      default: 200
    },

    width: {
      type: Number,
      required: false,
      default: 400
    }
  },

  components: { LineChart }
};
</script>
