<template>
<p class="field">
    <ais-clear class="button is-medium is-primary is-outlined">
        <span>Clear filters</span>
            <span class="icon">
            <i class="fas fa-times"></i>
        </span>
    </ais-clear>
</p>
</template>

<script>
import Clear from "vue-instantsearch";

export default {
  components: { Clear }
};
</script>

