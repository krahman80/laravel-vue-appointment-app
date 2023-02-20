<template>
  <div class="w-50 mx-auto">
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
            :class="[{'is-invalid':errorFor('email')}]"
          >
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
            :class="[{'is-invalid':errorFor('password')}]"
          >
          <v-errors :errors="errorFor(password)"></v-errors>
        </div>

        <div class="my-3">
          <button
            type="submit"
            class="btn btn-primary w-100"
            :disabled="loading"
            @click.prevent="login"
          >Login</button>
        </div>

        <hr />

        <div>
          No account yet? <router-link :to="{name:'home'}">Register</router-link>
        </div>
        <div>
          Forgot password? <router-link :to="{name:'home'}">Reset password</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import validationsErrors from "../components/utils/validationErrors";

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
          .then(() => axios.get("/user"))
          .catch((err) => {
            console.log(err.message);
            this.errors = err.response && err.response.data.errors;
          })
          .then(() => (this.loading = false));
      });

      // this.loading = false;
    },
  },
};
</script>