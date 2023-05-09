<template>
    <Gallery />
    <CallMe />
    <Regalia />
</template>

<script>
import CallMe from "./CallMe.vue";
import Gallery from "./Gallery.vue";
import Regalia from "./Regalia.vue";
export default {
    name: "Index",
    components: {
        CallMe,
        Gallery,
        Regalia,
    },
};
</script>
