require("./bootstrap");

import Vue from "vue";
import VCalendar from "v-calendar";
import moment from "moment";
import VueRouter from "vue-router";
import Vuex from 'vuex';
import router from "./routes";
import Index from "./Index";
import Error404 from "./components/shared/Error404";
import storeDefinition from "./store";

window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use(VCalendar, { componentPrefix: 'vc', });
Vue.use(Vuex);
//add momment into property of vue
Vue.prototype.$moment = moment;
Vue.component("error-404", Error404);

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        "index": Index,
    },
    beforeCreate() {
        this.$store.dispatch("getLastKeyword");

        // make auth request
        // axios.get("/sanctum/csrf-cookie");
        // axios.post("/login", {
        //     email: "xxx",
        //     password: "xxx"
        // }).catch(err => { console.log(err.response.status); });
        axios.get("/sanctum/csrf-cookie").then(response => {
            axios.post("/login", {
                email: "xxx",
                password: "xxx"
            }).catch(err => { console.log(err.response.code); });
        });
    }
});
