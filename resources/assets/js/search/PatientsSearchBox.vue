<template>
<div class="box">
  <div class="field">
    <p class="control">
      <ais-search-box>
        <ais-input autofocus="true" class="input" type="search" placeholder="Search patients..."></ais-input>
      </ais-search-box>
    </p>
  </div>

  <div class="field is-grouped">
      <label class="label">Results per page:</label>
      <p class="control">
        <div class="select">
          <ais-results-per-page-selector :options="options()"></ais-results-per-page-selector>
        </div>
      </p>
  </div>

  </br>
  <ais-powered-by></ais-powered-by>
</div>
</template>

<script>
import SearchBox from "vue-instantsearch";
import PoweredBy from "vue-instantsearch";

export default {
  props: {
    attributePerPage: {
      default: 100
    }
  },

  components: { SearchBox, PoweredBy },

  methods: {
    options() {
      return [15, 30, 50, Number(this.attributePerPage)]
        .filter((elem, index, self) => {
          return index === self.indexOf(elem);
        })
        .sort();
    }
  }
};
</script>
