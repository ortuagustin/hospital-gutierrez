import Vue from 'vue';

window.events = new Vue();

window.flash = function(message, type = 'is-success') {
  window.events.$emit('flash', { message, type });
};