<template>
  <div class="container">
    <p class="title" v-if="title" v-text="title"></p>

    <vue-export-chart-button @click="downloadAsPdf"></vue-export-chart-button>

    <bar-chart ref="chart" :endpoint="endpoint"></bar-chart>
  </div>
</template>

<script>
import BarChart from "../charts/BarChartImpl.js";
import ExportChartButton from "./ExportChartButton.vue";
import ContainsChart from "../charts/ContainsChart.js";

export default {
  mixins: [ContainsChart],

  components: { BarChart, ExportChartButton }
};
</script>
