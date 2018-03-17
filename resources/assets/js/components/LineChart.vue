<template>
  <div class="container">
    <p class="title" v-if="title" v-text="title"></p>

    <vue-export-chart-button @click="downloadAsPdf"></vue-export-chart-button>

    <line-chart ref="chart" :endpoint="endpoint" :width="width" :height="height"></line-chart>
  </div>
</template>

<script>
import LineChart from "../charts/LineChartImpl.js";
import ExportChartButton from "./ExportChartButton.vue";
import ContainsChart from "../charts/ContainsChart.js";

export default {
  mixins: [ContainsChart],

  components: { LineChart, ExportChartButton }
};
</script>
