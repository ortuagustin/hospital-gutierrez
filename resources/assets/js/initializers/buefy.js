import Vue from 'vue';
import Buefy from 'buefy';
import Toast from 'buefy/src/components/toast';
import Dialog from 'buefy/src/components/dialog';
import Collapse from 'buefy/src/components/collapse';
import Icon from 'buefy/src/components/icon';
import Switch from 'buefy/src/components/switch';
import Datepicker from 'buefy/src/components/datepicker';
import Select from 'buefy/src/components/select';

Vue.prototype.$toast = Toast;
Vue.prototype.$dialog = Dialog;
Vue.prototype.confirm = function(title, message, type, onConfirm, onCancel) {
  this.$dialog.confirm({
    title,
    message,
    onConfirm,
    onCancel,
    type,
    hasIcon: true,
    iconPack: "fas",
    size: "is-medium"
  });
}

Vue.component('b-collapse', Collapse);
Vue.component('b-icon', Icon);
Vue.component('b-switch', Switch);
Vue.component('b-datepicker', Datepicker);
Vue.component('b-select', Select);