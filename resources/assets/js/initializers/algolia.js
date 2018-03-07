import Vue from 'vue';
import InstantSearch from 'vue-instantsearch';
import SearchTypeFilter from '../algolia/SearchTypeFilter.vue';
import PatientSearchResults from '../algolia/PatientSearchResults.vue';
import SearchAgeFilter from '../algolia/SearchAgeFilter.vue';
import PatientsSearchBox from '../algolia/PatientsSearchBox.vue';
import ClearSearchFilters from '../algolia/ClearSearchFilters.vue';

Vue.use(InstantSearch);
Vue.component('search-type-filter', SearchTypeFilter);
Vue.component('patient-search-results', PatientSearchResults);
Vue.component('search-age-filter', SearchAgeFilter);
Vue.component('patients-search-box', PatientsSearchBox);
Vue.component('clear-search-filters', ClearSearchFilters);