import { h, resolveComponent } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import createStore from "../store/index.js";

import DefaultLayout from "@/admin/layouts/DefaultLayout.vue";
import Pages from "@/front/components/Pages.vue";
// import Index from "@/admin/main/Index.vue";
// import MainLayout from "@/layouts/MainLayout.vue";
// import Pages from "@/main/Pages.vue";

const routes = [
    // {
    //     path: "/page/:slug", // slug is the dynamic parameter
    //     component: Pages,
    //     props: true, // allows passing slug as a prop to the component
    // },
    {
        path: "/admin/",
        name: "Home",
        component: DefaultLayout,
        redirect: "/admin/login",
        children: [
            {
                path: "/admin/personal/add-personal",
                name: "AddPersonal",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddPersonal.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/personal/:id", // id is the dynamic parameter
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddPersonal.vue"
                    ),
                props: true, // allows passing id as a prop to the component
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/images/add-page",
                name: "AddPage",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddPage.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/pages",
                name: "Pages",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/Pages.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/pages/:slug", // slug is the dynamic parameter
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddPage.vue"
                    ),
                props: true, // allows passing slug as a prop to the component
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/contacts",
                name: "Contacts",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/Contacts.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/main-page",
                name: "MainPage",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/MainPage.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/user",
                name: "User",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/User.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/regalias/create-regalia",
                name: "CreateRegalia",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddRegalia.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/regalia/:id",
                name: "UpdateRegalia",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddRegalia.vue"
                    ),
                props: true,
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/regalias",
                name: "Regalias",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/Regalias.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/tabs",
                name: "Tabs",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/Tabs.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/tabs/create-tab",
                name: "AddTab",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddTab.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/tabs/:id",
                name: "UpdateTab",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/admin/pages/AddTab.vue"
                    ),
                props: true,
                meta: { requiresAuth: true },
            },
        ],
    },

    {
        path: "/admin/login",
        name: "Login",
        component: () => import("@/admin/views/pages/Login.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior() {
        // always scroll to top
        return { top: 0 };
    },
});

router.beforeEach((to, from, next) => {
    if (
        to.path.startsWith("/admin/") &&
        to.path !== "/admin/login" &&
        to.path !== "/admin/login/" &&
        to.path !== "/admin/logout" &&
        to.matched.some((record) => record.meta.requiresAuth)
    ) {
        const accessToken = localStorage.getItem("access_token");
        // console.log("beforeEach:" + accessToken);
        if (!accessToken) {
            next({ name: "Login" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
