<template>
  <div class="w-50 mx-auto">
    <div class="card card-body">
      <form>
        <div class="my-3">
          <label for="email">Name</label>
          <input
            type="text"
            name="name"
            placeholder="enter name"
            class="form-control shadow-none"
            v-model="user.name"
            :class="[{ 'is-invalid': errorFor('name') }]"
          />
          <v-errors :errors="errorFor(user.name)"></v-errors>
        </div>
        <div class="my-3">
          <label for="email">Email</label>
          <input
            type="text"
            name="email"
            placeholder="enter email"
            class="form-control shadow-none"
            v-model="user.email"
            :class="[{ 'is-invalid': errorFor('email') }]"
          />
          <v-errors :errors="errorFor(user.email)"></v-errors>
        </div>
        <div class="mb-3">
          <label for="email">Password</label>
          <input
            type="password"
            name="password"
            placeholder="enter password"
            class="form-control shadow-none"
            v-model="user.password"
            :class="[{ 'is-invalid': errorFor('password') }]"
          />
          <v-errors :errors="errorFor(user.password)"></v-errors>
        </div>

        <div class="mb-3">
          <label for="email">Re-type Password</label>
          <input
            type="password"
            name="password_confirmation"
            placeholder="confirm password"
            class="form-control shadow-none"
            v-model="user.password_confirmation"
            :class="[{ 'is-invalid': errorFor('password_confirmation') }]"
          />
          <v-errors :errors="errorFor(user.password_confirmation)"></v-errors>
        </div>
        <div class="my-3">
          <button
            type="submit"
            class="btn btn-primary w-100"
            :disabled="loading"
            @click.prevent="register"
          >
            Register
          </button>
        </div>

        <hr />

        <div>
          Have an account?
          <router-link :to="{ name: 'login' }">Login</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import validationsErrors from "../components/utils/validationErrors";
import { logIn } from "../components/utils/auth.js";

export default {
  mixins: [validationsErrors],
  data() {
    return {
      user: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      loading: false,
    };
  },
  methods: {
    async register() {
      this.loading = true;
      this.errors = null;

      // make auth request
      axios
        .post("/register", this.user)
        .then((response) => {
          if (201 == response.status) {
            //call logIn method in auth
            logIn();

            //call user method inside store
            this.$store.dispatch("loadUser");

            //redirect to home
            this.$router.push({ name: "home" });
          }
        })
        .catch((err) => {
          // console.log(err.message);
          this.errors = err.response && err.response.data.errors;
        })
        .then(() => (this.loading = false));
    },
  },
};
</script>