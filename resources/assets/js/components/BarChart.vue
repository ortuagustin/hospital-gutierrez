<template>
  <div class="container">
    <p class="title" v-text="title"> </p>
    <bar-chart :endpoint="endpoint"></bar-chart>
  </div>
</template>

<script>
import BarChart from '../BarChartImpl.js';

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

  components: { BarChart }
}
</script>
