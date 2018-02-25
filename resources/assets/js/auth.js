import Vue from 'vue';
import Modal from './components/Modal.vue';

const auth = new Vue({
  data() {
    return {
      loginForm: {},
      registerForm: {}
    };
  },

  mounted() {
    this.loginForm = this.$refs.loginForm;
    this.registerForm = this.$refs.registerForm;
  },

  components: {
    Modal
  },

  methods: {
    showLoginForm() {
      this.loginForm.show();
    },

    showRegisterForm() {
      this.registerForm.show();
    }
  }
});

if (document.getElementById('auth')) {
  auth.$mount('#auth');
}
