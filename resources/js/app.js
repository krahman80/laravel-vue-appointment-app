require("./bootstrap");

import Vue from "vue";
import VCalendar from "v-calendar";
import moment from "moment";
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";

//add momment into property of vue
Vue.prototype.$moment = moment;

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
