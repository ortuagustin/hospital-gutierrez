export default {
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
}