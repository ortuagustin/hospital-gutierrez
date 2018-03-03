<template>
<div>
    <ais-results>
        <template slot-scope="{ result }">
            <p>
                <a :href="result.path" class="is-size-5">
                    <ais-highlight :result="result" :attribute-name="attributeName"></ais-highlight>
                </a>
            </p>
        </template>
    </ais-results>

    <ais-no-results>
        <template slot-scope="props">
            No Patients found <span v-if="props.query"> for <b>{{ props.query }}</b></span>
        </template>
    </ais-no-results>
</div>
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
