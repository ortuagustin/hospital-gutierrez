import { Line, mixins } from "vue-chartjs";
import AjaxChart from "./AjaxChart.js";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Line,

  mixins: [mixins.reactiveData, AjaxChart]
};