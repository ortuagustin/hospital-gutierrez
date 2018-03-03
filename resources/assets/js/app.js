import Vue from 'vue';
import InstantSearch from 'vue-instantsearch';
import { Index, Clear, Highlight } from 'vue-instantsearch';
import UserRoleSelect from './components/UserRoleSelect.vue';
import SearchTypeFilter from './search/SearchTypeFilter.vue';
import PatientSearchResults from './search/PatientSearchResults.vue';
import SearchAgeFilter from './search/SearchAgeFilter.vue';
import PatientsSearchBox from './search/PatientsSearchBox.vue';
import ClearSearchFilters from './search/ClearSearchFilters.vue';

Vue.use(InstantSearch);

const app = new Vue({
    components: {
        UserRoleSelect,
        SearchTypeFilter,
        PatientSearchResults,
        SearchAgeFilter,
        PatientsSearchBox,
        ClearSearchFilters,
        Index,
        Highlight
    },
});

if (document.getElementById('app')) {
    app.$mount('#app');
}