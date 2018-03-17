import { Bar, mixins } from "vue-chartjs";
import AjaxChart from "./AjaxChart.js";
import ExportableChart from "./ExportableChart.js";

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  extends: Bar,

  mixins: [mixins.reactiveData, AjaxChart, ExportableChart]
};