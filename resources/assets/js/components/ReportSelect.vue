<template>
<b-select name="reports" id="reports" v-model="selected" @input="$emit('input', selected)">
    <option v-for="each in items" :key="each.endpoint" :value="each.endpoint">
      {{ each.title }}
    </option>
</b-select>
</template>

<script>
export default {
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      selected: null,
      items: []
    };
  },

  mounted() {
    axios.get(this.endpoint).then(
      function(response) {
        this.items = response.data;
        this.selected = this.items[0].endpoint;
      }.bind(this)
    );
  }
};
</script>
