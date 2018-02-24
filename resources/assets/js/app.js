import Vue from 'vue';
import Modal from './components/Modal.vue';
import PieChart from './components/PieChart.vue';
import BarChart from './components/BarChart.vue';
import LineChart from './components/LineChart.vue';

new Vue({
  el: '#app',

  data() {
    return {
      loginForm: {},
      registerForm: {}
    };
  },

  mounted() {
    this.loginForm = this.$refs.loginForm;
    this.registerForm = this.$refs.registerForm;
  },

  components: {
    Modal,
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
