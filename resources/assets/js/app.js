import Vue from 'vue';
import axios from 'axios';
import InstantSearch from 'vue-instantsearch';
import VModal from 'vue-js-modal';
import Login from './components/Login';
import Register from './components/Register';
import Logout from './components/Logout';
import UserRoleSelect from './components/UserRoleSelect.vue';
import SearchTypeFilter from './search/SearchTypeFilter.vue';
import PatientSearchResults from './search/PatientSearchResults.vue';
import SearchAgeFilter from './search/SearchAgeFilter.vue';
import PatientsSearchBox from './search/PatientsSearchBox.vue';
import ClearSearchFilters from './search/ClearSearchFilters.vue';
import PieChart from './components/PieChart.vue';
import BarChart from './components/BarChart.vue';
import LineChart from './components/LineChart.vue';
import SettingInput from './components/SettingInput.vue';
import SettingCheckbox from './components/SettingCheckbox.vue';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error(
    'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
  );
}

Vue.use(InstantSearch);
Vue.use(VModal);

const app = new Vue({
  el: "#app",

  components: {
    UserRoleSelect,
    SearchTypeFilter,
    PatientSearchResults,
    SearchAgeFilter,
    PatientsSearchBox,
    ClearSearchFilters,
    VModal,
    Login,
    Register,
    Logout,
    PieChart,
    LineChart,
    BarChart,
    SettingInput,
    SettingCheckbox
  },
});