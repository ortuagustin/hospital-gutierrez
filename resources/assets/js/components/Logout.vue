<template>
  <a href="#" class="navbar-item" @click="logout">
    <slot></slot>
  </a>
</template>

<script>
export default {
  methods: {
    logout() {
      axios.post("/logout").then(() => location.reload());
    }
  }
};
</script>