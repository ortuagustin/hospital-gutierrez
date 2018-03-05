import { Line } from "vue-chartjs";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Line,

  mounted() {
    axios.get(this.endpoint).then(
      function(response) {
        this.renderChart(response.data.chart, response.data.options);
      }.bind(this)
    );
  }
};