<template>
  <div class="container">
    <p class="title" v-if="title" v-text="title"></p>

    <vue-export-chart-button @click="downloadAsPdf">
      <p>&darr;</p>
    </vue-export-chart-button>

    <pie-chart ref="chart" :endpoint="endpoint"></pie-chart>
  </div>
</template>

<script>
import PieChart from "../charts/PieChartImpl.js";
import ExportChartButton from "./ExportChartButton.vue";
import ContainsChart from "../charts/ContainsChart.js";

export default {
  mixins: [ContainsChart],

  components: { PieChart, ExportChartButton }
};
</script>
