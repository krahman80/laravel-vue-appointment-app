require("./bootstrap");

import Vue from "vue";
import VCalendar from "v-calendar";
// const VCalendar = require("v-calendar");

import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";

window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use(VCalendar, { componentPrefix: 'vc', });

const app = new Vue({
    el: "#app",
    router,
    components: {
        "index": Index,
    }
});
