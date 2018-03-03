<template>
<div class="box">
  <p class="field">
    <ais-search-box>
      <ais-input autofocus="true" class="input" type="search" placeholder="Search patients..."></ais-input>
    </ais-search-box>
  </p>

  </br>
  <ais-powered-by></ais-powered-by>
</div>
</template>

<script>
import SearchBox from "vue-instantsearch";
import PoweredBy from "vue-instantsearch";

export default {
  components: { SearchBox, PoweredBy }
};
</script>
