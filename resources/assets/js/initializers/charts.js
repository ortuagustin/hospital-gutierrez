import Vue from 'vue';
import PieChart from '../components/PieChart.vue';
import BarChart from '../components/BarChart.vue';
import LineChart from '../components/LineChart.vue';
import ExportChartButton from '../components/ExportChartButton.vue';

Vue.component('vue-pie-chart', PieChart);
Vue.component('vue-bar-chart', BarChart);
Vue.component('vue-line-chart', LineChart);
Vue.component('vue-export-chart-button', ExportChartButton);