import VueRouter from "vue-router";
import DoctorList from "./components/DoctorList";
import AboutComponent from "./components/AboutComponent";

const routes = [
    {
        path: "/",
        name: "home",
        component: DoctorList,
    },
    {
        path: "/about",
        name: "about",
        component: AboutComponent,
    }
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;