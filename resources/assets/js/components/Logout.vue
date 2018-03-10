<template>
  <a href="#" class="navbar-item" @click="logout">
    <slot></slot>
  </a>
</template>

<script>
export default {
  methods: {
    logout() {
      /** ignore errors because when site is down, it will respond with a 503 error
       *  this leads to duplciated logic on both then and catch methods..
       */
      axios
        .post("/logout", {
          validateStatus: () => {
            return true;
          }
        })
        .then(() => location.replace("/"))
        .catch(() => location.replace("/"));
    }
  }
};
</script>