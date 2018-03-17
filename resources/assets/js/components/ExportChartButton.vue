<template>
  <button class="button" @click="$emit('click')">
      <b-icon type="is-danger" pack="fas" icon="file-pdf"></b-icon>
      <slot>
        <span>Save as PDF &darr;</span>
      </slot>
  </button>
</template>

<script>
export default {};
</script>
