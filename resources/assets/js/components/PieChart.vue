<template>
  <div class="container">
    <p class="title" v-text="title"> </p>
    <pie-chart :endpoint="endpoint"></pie-chart>
  </div>
</template>

<script>
import PieChart from '../PieChartImpl.js';

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

  components: { PieChart }
}
</script>
