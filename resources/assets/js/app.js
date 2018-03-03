import Vue from 'vue';
import InstantSearch from 'vue-instantsearch';
import UserRoleSelect from './components/UserRoleSelect.vue';
import SearchTypeFilter from './search/SearchTypeFilter.vue';
import PatientSearchResults from './search/PatientSearchResults.vue';

Vue.use(InstantSearch);

const app = new Vue({
    components: { UserRoleSelect, SearchTypeFilter, PatientSearchResults },
});

if (document.getElementById('app')) {
    app.$mount('#app');
}