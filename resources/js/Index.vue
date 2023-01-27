<template>
  <div>
    <nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm">
      <div class="container">

        <router-link
          class="navbar-brand"
          :to="{name:'home'}"
        >
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
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
          class="navbar-toggler"
        ><span class="navbar-toggler-icon"></span></button>

        <div
          id="navbarSupportedContent"
          class="collapse navbar-collapse"
        >
          <ul class="navbar-nav ms-auto">

            <li class="nav-item">
              <router-link
                class="nav-link"
                aria-current="page"
                :to="{name:'home'}"
              >Home</router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                aria-current="page"
                :to="{name:'about'}"
              >About</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5">
      <router-view></router-view>
    </div>

  </div>
</template>