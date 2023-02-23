require("./bootstrap");

// import Vue from "vue";
import VCalendar from "v-calendar";
import moment from "moment";
import VueRouter from "vue-router";
import Vuex from "vuex";
import router from "./routes";
import Index from "./Index";
import storeDefinition from "./store";


window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use(VCalendar, { componentPrefix: 'vc', });
Vue.use(Vuex);
//add momment into property of vue
Vue.prototype.$moment = moment;
//mount component
Vue.component("error-404", require("./components/shared/Error404").default);
Vue.component("v-errors", require("./components/shared/validationErrors").default);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logoutUser");
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        "index": Index,
    },
    beforeCreate() {
        // this.$store.dispatch("getLastKeyword");
        this.$store.dispatch("loadStoredState");
        this.$store.dispatch("loadUser");
        // make auth request
        // axios.get("/sanctum/csrf-cookie").then(() => {
        //     axios.post("/login", {
        //         email: "userYYY@mail.com",
        //         password: "password"
        //     }).then(() => axios.get("/user")).catch(err => { console.log(err.message); });
        // });

    }
});
