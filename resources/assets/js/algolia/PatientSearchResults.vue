<template>
    <div class="results-container">
        <ais-results>
            <template slot-scope="{ result }">
                <slot :patient="result"></slot>
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
import NoResults from "vue-instantsearch";

export default {
  components: { NoResults, Results }
};
</script>

<style>
.ais-highlight > em {
  background: yellow;
  font-weight: bold;
}

.results-container {
  margin-top: 3.5rem;
}
</style>
