<template>
  <div class="container">
    <p class="title" v-if="title" v-text="title"> </p>
    <pie-chart :endpoint="endpoint"></pie-chart>
  </div>
</template>

<script>
import PieChart from "../charts/PieChartImpl.js";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    },

    title: {
      type: String,
      default: ""
    }
  },

  components: { PieChart }
};
</script>
