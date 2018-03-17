import { Bar, mixins } from "vue-chartjs";
const { reactiveData } = mixins

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Bar,

  mixins: [reactiveData],

  data() {
    return {
      options: []
    }
  },

  mounted() {
    this.fetch(this.endpoint)
  },

  watch: {
    endpoint: function(url) {
      this.fetch(url)
    }
  },

  methods: {
    fetch(url) {
      axios.get(url).then(
        function(response) {
          this.options = response.data.options;
          this.chartData = response.data.chart;
        }.bind(this)
      );
    }
  }
};