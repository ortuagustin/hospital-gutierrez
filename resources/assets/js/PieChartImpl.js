import { Pie } from "vue-chartjs";
import axios from "axios";

export default {
    props: {
        endpoint: {
          type: String,
          required: true
        }
    },

    extends: Pie,

    mounted() {
        axios.get(this.endpoint).then(
            function(response) {
                this.renderChart(response.data.chart, response.data.options);
            }.bind(this)
        );
    }
};
