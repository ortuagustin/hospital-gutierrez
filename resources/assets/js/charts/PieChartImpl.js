import { Pie, mixins } from "vue-chartjs";
import AjaxChart from "./AjaxChart.js";
import ExportableChart from "./ExportableChart.js";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Pie,

  mixins: [mixins.reactiveData, AjaxChart, ExportableChart],
};