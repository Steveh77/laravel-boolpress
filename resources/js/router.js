import Vue from "vue";
import VueRouter from "vue-router";

import HomePage from "./components/pages/HomePage.vue";
import AboutPage from "./components/pages/AboutPage.vue";
import ContactsPage from "./components/pages/ContactsPage.vue";
import PageNotFound from "./components/pages/PageNotFound.vue";
import PostShow from "./components/posts/PostShow.vue";

Vue.use(VueRouter);

// Definisco le rotte
const routes = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        { path: "/", component: HomePage, name: "home" },
        { path: "/about", component: AboutPage, name: "about" },
        { path: "/contacts", component: ContactsPage, name: "contacts" },
        { path: "/posts/:id", component: PostShow, name: "post-show" },

        { path: "*", component: PageNotFound, name: "not_found" },
    ],
});

export default routes;
