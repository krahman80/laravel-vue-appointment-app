import VueRouter from "vue-router";
import DoctorList from "./components/DoctorList";
import DoctorShow from "./components/DoctorShow";
import AboutComponent from "./components/AboutComponent";
import Error404 from "./components/Error404";

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
        path: '/404',
        name: "404",
        component: Error404
    },
    {
        path: '\*',
        redirect: '/404'
    },

];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;