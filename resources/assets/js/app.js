import Vue from 'vue';
import './initializers/axios.js';
import './initializers/events.js';
import './initializers/modal.js';
import './initializers/components.js';
import './initializers/charts.js';
import './initializers/algolia.js';
import './initializers/buefy.js';


const app = new Vue({
  el: "#app",
});