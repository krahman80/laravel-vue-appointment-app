import VueRouter from "vue-router";
import DoctorList from "./components/DoctorList";
import DoctorShow from "./components/DoctorShow";
import AboutComponent from "./components/AboutComponent";
import Login from "./components/Login"

const routes = [
    {
        path: "/",
        name: "home",
        component: DoctorList,
    },
    {
        path: "/doctors/:id",
        name: "doctor",
        component: DoctorShow,
    },
    {
        path: "/about",
        name: "about",
        component: AboutComponent,
    },
    {
        path: "/auth/login",
        name: "login",
        component: Login
    }
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;