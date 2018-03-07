import Vue from 'vue';
import Buefy from 'buefy';
import Toast from 'buefy/src/components/toast';
import Dialog from 'buefy/src/components/dialog';

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