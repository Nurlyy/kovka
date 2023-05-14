import { createRouter, createWebHistory } from "vue-router";

import Index from "@/front/components/Index.vue";

const routes = [
    {
        path: "/",
        name: "Main",
        component: Index,
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
