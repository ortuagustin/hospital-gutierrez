import Vue from 'vue';
import PieChart from './components/PieChart.vue';
import BarChart from './components/BarChart.vue';
import LineChart from './components/LineChart.vue';

const charts = new Vue({
  components: {
    PieChart,
    LineChart,
    BarChart
  },

  methods: {
    showLoginForm() {
      this.loginForm.show();
    },

    showRegisterForm() {
      this.registerForm.show();
    }
  }
});

if (document.getElementById('charts')) {
  charts.$mount('#charts');
}
