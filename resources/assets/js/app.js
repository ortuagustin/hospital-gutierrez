import Vue from 'vue';
import Modal from './components/Modal.vue';

new Vue({
  el: '#app',

  data() {
    return {
      loginForm: {}
    };
  },

  mounted() {
    this.loginForm = this.$refs.loginForm;
  },

  components: {
    Modal
  },

  methods: {
    showLoginForm() {
      this.loginForm.show();
    }
  }
});