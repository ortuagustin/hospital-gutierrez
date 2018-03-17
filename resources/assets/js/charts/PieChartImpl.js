import { Pie } from "vue-chartjs";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Pie,

  mounted() {
    this.render(this.endpoint);
  },

  watch: {
    endpoint: function(value) {
      this.render(value)
    }
  },

  methods: {
    render(url) {
      axios.get(url).then(
        function(response) {
          this.renderChart(response.data.chart, response.data.options);
        }.bind(this)
      );
    }
  }
};