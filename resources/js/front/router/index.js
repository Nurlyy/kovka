import { createRouter, createWebHistory } from "vue-router";

import Index from "@/front/components/Index.vue";
import Pages from "@/front/components/Pages.vue";
import Blog from "@/front/components/Blog.vue";


const routes = [
    {
        path: "/page/:slug", // slug is the dynamic parameter
        component: Pages,
        props: true, // allows passing slug as a prop to the component
    },
    {
        path: "/",
        name: "Main",
        component: Index,
    },
    {
        path: "/blog",
        name: "Blog",
        component: Blog,
    },
    {
        path: "/:catchAll(.*)", // Catch-all route
        name: "NotFound",
        component: () => import("@/front/components/NotFound.vue"), // Import the component for your 404 page
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

export default router;
