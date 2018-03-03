<template>
  <ais-results>
      <template slot-scope="{ result }">
          <p>
              <a :href="result.path" class="is-size-5">
                  <ais-highlight :result="result" :attribute-name="attributeName"></ais-highlight>
              </a>
          </p>
      </template>
  </ais-results>
</template>

<script>
import Results from "vue-instantsearch";

export default {
  props: ["attributeName"],

  components: { Results }
};
</script>

<style>
.ais-highlight > em {
  background: yellow;
  font-weight: bold;
}
</style>
