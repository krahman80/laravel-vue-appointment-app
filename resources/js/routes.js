import VueRouter from "vue-router";
import HomeComponent from "./components/HomeComponent";
import AboutComponent from "./components/AboutComponent";

const routes = [
    {
        path: '/',
        name: "home",
        component: HomeComponent,
    },
    {
        path: '/about',
        name: 'about',
        component: AboutComponent,
    }
];

const router = new VueRouter({
    routes,
    mode:"history",
});

export default router;