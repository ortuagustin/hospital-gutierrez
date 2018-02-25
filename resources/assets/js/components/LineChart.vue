<template>
  <div class="container">
    <p class="title" v-text="title"> </p>
    <line-chart :endpoint="endpoint"></line-chart>
  </div>
</template>

<script>
import LineChart from '../charts/LineChartImpl.js';

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    },

    title: {
      type: String,
      required: true
    }
  },

  components: { LineChart }
}
</script>
