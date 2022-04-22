import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import Search from "./pages/Search";
import PageNotFound from "./pages/PageNotFound";
import SingleDoctor from "./pages/SingleDoctor";
import Message from "./pages/Message";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/search" ,
            name: "search",
            component: Search
        },
        {
            path: "/doctors/:id",  //per lo show
            name: "single-doctor",
            component: SingleDoctor
        },
        {
            path: "/doctors/:id/message",  //vista per invio del messaggio
            name: "message",
            component: Message
        },
        {
            path: "*" ,
            name: "page-404",
            component: PageNotFound
        },
    ]
});

export default router