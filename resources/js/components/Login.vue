<template>
  <div class="row">
    <div class="col-sm-12 col-lg-6 mx-auto">
      <div class="card card-body">
        <form>
          <div class="my-3">
            <label for="email">Email</label>
            <input
              type="text"
              name="email"
              placeholder="enter email"
              class="form-control shadow-none"
              v-model="email"
              :class="[{ 'is-invalid': errorFor('email') }]"
            />
            <v-errors :errors="errorFor(email)"></v-errors>
          </div>
          <div class="mb-3">
            <label for="email">Password</label>
            <input
              type="password"
              name="password"
              placeholder="enter password"
              class="form-control shadow-none"
              v-model="password"
              :class="[{ 'is-invalid': errorFor('password') }]"
            />
            <v-errors :errors="errorFor(password)"></v-errors>
          </div>

          <div class="my-3">
            <button
              type="submit"
              class="btn btn-primary w-100"
              :disabled="loading"
              @click.prevent="login"
            >
              Login
            </button>
          </div>

          <hr />

          <div>
            No account yet?
            <router-link :to="{ name: 'register' }">Register</router-link>
          </div>
          <div>
            Forgot password?
            <router-link :to="{ name: 'home' }">Reset password</router-link>
          </div>
        </form>
      </div>
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
      email: null,
      password: null,
      loading: false,
    };
  },
  methods: {
    login() {
      this.loading = true;
      this.errors = null;

      // make auth request
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/login", {
            email: this.email,
            password: this.password,
          })
          .then(() => {
            // axios.get("/user")
            //call logIn method in auth
            logIn();

            //call user method inside store
            this.$store.dispatch("loadUser");

            //redirect to home
            this.$router.push({ name: "home" });
          })
          .catch((err) => {
            // console.log(err.message);
            this.errors = err.response && err.response.data.errors;
          })
          .then(() => (this.loading = false));
      });
    },
  },
};
</script>