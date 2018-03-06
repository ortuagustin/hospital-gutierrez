import Vue from 'vue';
import SettingInput from './components/SettingInput.vue';
import SettingCheckbox from './components/SettingCheckbox.vue';

const settings = new Vue({
  components: { SettingInput, SettingCheckbox }
});

if (document.getElementById('settings')) {
  settings.$mount('#settings');
}