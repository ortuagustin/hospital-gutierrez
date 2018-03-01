import Vue from 'vue';
import UserRoleSelect from './components/UserRoleSelect.vue';

const app = new Vue({
  components: { UserRoleSelect },
});

if (document.getElementById('app')) {
  app.$mount('#app');
}
