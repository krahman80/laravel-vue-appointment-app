require("./bootstrap");

import Vue from "vue";
import VCalendar from "v-calendar";
import moment from "moment";
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";
import Error404 from "./components/shared/Error404";

window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use(VCalendar, { componentPrefix: 'vc', });
//add momment into property of vue
Vue.prototype.$moment = moment;
Vue.component("error-404", Error404);

const app = new Vue({
    el: "#app",
    router,
    components: {
        "index": Index,
    }
});
