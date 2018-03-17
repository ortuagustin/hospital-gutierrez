export default {
  props: {
    endpoint: {
      type: String,
      required: true
    },

    title: {
      type: String,
      default: ""
    },

    height: {
      type: Number,
      required: false,
      default: 200
    },

    width: {
      type: Number,
      required: false,
      default: 400
    }
  },

  methods: {
    downloadAsPdf() {
      this.$refs.chart.asPDF();
    }
  }
}