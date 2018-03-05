<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: ""
      },

      loading: false,
      feedback: ""
    };
  },

  methods: {
    login() {
      this.loading = true;

      axios
        .post("/login", this.form)
        .then(() => location.reload())
        .catch(error => {
          this.loading = false;
          this.feedback = error.response.data["email"];
        });
    },

    register() {
      this.$modal.hide("login");
      this.$modal.show("register");
    },

    cantSendLogin() {
      return this.feedback != "" || this.loading;
    }
  }
};
</script>

<style>
@import "modals.css";
</style>
