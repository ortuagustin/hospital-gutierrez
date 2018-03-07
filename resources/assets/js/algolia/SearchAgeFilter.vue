<template>
<div class="box">
  <p class="title is-5 has-text-info is-uppercase">
    Filter by Age
  </p>

  <p class="label">from</p>
  <ais-range-input
    attribute-name="age"
    :class-names="{
        'ais-range-input__input': 'field input',
        'ais-range-input__submit': 'field button is-primary',
        'ais-range-input__separator': 'label'
    }"
    />
</div>
</template>

<script>
import RangeInput from "vue-instantsearch";

export default {
  components: { RangeInput }
};
</script>
