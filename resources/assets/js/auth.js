import Vue from 'vue';
import VModal from 'vue-js-modal';
import Login from './components/Login';
import Register from './components/Register';
import Logout from './components/Logout';

Vue.use(VModal);

const auth = new Vue({
  components: { VModal, Login, Register, Logout }
});

if (document.getElementById('auth')) {
  auth.$mount('#auth');
}