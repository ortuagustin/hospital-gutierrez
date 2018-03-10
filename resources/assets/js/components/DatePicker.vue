<template>
<div>
  <input type="hidden" :name="fieldName" :id="fieldName" v-model="inputDate">

  <b-datepicker
    placeholder="Click to pick a date..."
    icon-pack="fas"
    icon="fas fa-clock"
    :date-formatter="formatter()"
    v-model="date"
  >
  </b-datepicker>

  <slot></slot>
</div>
</template>

<script>
export default {
  props: ["fieldName", "dataDate"],

  data() {
    return {
      date: new Date(moment(this.dataDate).format()),
      inputDate: this.dataDate
    };
  },

  watch: {
    date: function(value) {
      this.inputDate = moment(value).format("YYYY-MM-DD");
    }
  },

  methods: {
    formatter() {
      return value => {
        return moment(value).format("DD/MM/YYYY");
      };
    }
  }
};
</script>

