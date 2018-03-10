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
        .then(() => location.replace("/"))
        .catch(error => {
          this.loading = false;

          if (error.response.status == 422) {
            this.feedback = error.response.data["email"];
          }

          if (error.response.status == 503) {
            location.replace("/");
          }
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
