<script>
import VModal from "vue-js-modal";
import Login from "./Login";
import Register from "./Register";
import Logout from "./Logout";

export default {
  components: { VModal, Login, Register, Logout },

  data() {
    return {
      toggled: false
    };
  },

  computed: {
    burgerClass: function() {
      return this.toggled ? "is-active" : "";
    }
  }
};
</script>
