<template>
  <div>
    <nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm">
      <div class="container w-75">
        <router-link class="navbar-brand" :to="{ name: 'home' }">
          <!-- Logo Image -->
          <!-- <img
            src="https://bootstrapious.com/i/snippets/sn-nav-logo/logo.png"
            width="45"
            alt=""
            class="d-inline-block align-middle mr-2"
          > -->
          <!-- Logo Text -->
          <span class="font-weight-bold">Appointment App</span>
        </router-link>
        <button
          class="navbar-toggler shadow-none"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <!-- <li class="nav-item">
              <router-link
                class="nav-link"
                aria-current="page"
                :to="{name:'about'}"
              >About</router-link>
            </li> -->
            <li class="nav-item" v-if="isLogin">
              <span class="nav-link">hello, {{ userName }}</span>
            </li>
            <li class="nav-item" v-if="isLogin">
              <a class="nav-link" href="#" @click.prevent="logout">Logout</a>
            </li>

            <li class="nav-item" v-if="!isLogin">
              <router-link
                class="nav-link"
                aria-current="page"
                :to="{ name: 'login' }"
                >Login</router-link
              >
            </li>
            <li class="nav-item" v-if="!isLogin">
              <router-link
                class="nav-link"
                aria-current="page"
                :to="{ name: 'register' }"
                >Register</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container w-75 my-5">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userName: null,
    };
  },
  computed: {
    isLogin() {
      this.checkLogin();
      return this.$store.state.isLogin;
    },
  },
  methods: {
    async logout() {
      try {
        axios.post("/logout");
        this.$store.dispatch("logoutUser");
      } catch (error) {
        this.$store.dispatch("logoutUser");
      }
    },
    checkLogin() {
      this.userName = this.$store.state.user.name;
    },
  },
};
</script>