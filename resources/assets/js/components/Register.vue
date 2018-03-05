<script>
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },

      errors: {},
      loading: false
    };
  },

  methods: {
    register() {
      this.loading = true;

      axios
        .post("/register", this.form)
        .then(response => {
          location.reload();
        })
        .catch(error => {
          this.loading = false;
          this.errors = error.response.data;
        });
    },

    login() {
      this.$modal.show("login");
      this.$modal.hide("register");
    }
  }
};
</script>

<style>
@import "modals.css";
</style>
