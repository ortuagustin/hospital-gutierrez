<template>
  <ais-refinement-list
    class="box"
    :attribute-name="attributeName"
    :class-names="{
        'ais-refinement-list__item': 'refinement-list-item has-text-grey has-text-weight-bold',
        'ais-refinement-list__count': 'tag is-info is-rounded is-pulled-right'
    }"
  >

      <template slot="header">
          <p class="title is-4 has-text-info is-uppercase">
            <slot></slot>
          </p>
      </template>

  </ais-refinement-list>
</template>

<script>
import RefinementList from "vue-instantsearch";

export default {
  props: ["attributeName"],

  components: { RefinementList }
};
</script>

<style>
.refinement-list-item {
  margin-bottom: 5px;
  margin-top: 5px;
}
</style>
