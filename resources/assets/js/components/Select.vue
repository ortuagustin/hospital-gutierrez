<template>
<b-select :name="name" :id="name" v-model="data">
    <option v-for="each in items" :key="each.id" :value="each.id">
      {{ each.value }}
    </option>
</b-select>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: []
    },

    name: {
      type: String,
      required: true
    },

    dataSelected: {
      type: String,
      default: null
    }
  },

  data() {
    return {
      data: this.dataSelected
    };
  }
};
</script>
