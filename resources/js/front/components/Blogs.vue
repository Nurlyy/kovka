<template>
    <TopLineNavigation />
    <div class="mine-conteaner">
        <div class="page">
            <h1>
                {{ page.title }}
            </h1>
            <div class="conteaner-page">
                <div v-html="page.body"></div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from './TopLineNavigation.vue';
import Footer from './Footer.vue';
export default {
    name: "Page",
    components: {
        TopLineNavigation, Footer,
    },
    data() {
        return {
            page: null,
            pages: null,
        };
    },
    mounted() {
        const slug = this.$route.params.slug;
        axios.post("/api/get-page", { slug: slug }).then((response) => {
            this.page = response.data.page;
            document.title = this.page.header_title;
            console.log(response.data);
        });
    },
    created(){
        const slug = this.$route.params.slug;
        if (slug) {
            
        }
    }
};
</script>

<style scoped lang="scss">
.page {
    .conteaner-logo {
        width: 100%;
        text-align: center;
        height: auto;
        padding: 50px 0 40px;
        .logo {
            margin-left: 8px;
        }
    }
    h1 {
        display: block;
        width: 100%;
        color: var(--color-purple-h2);
        font-size: var(--font-saze-h1);
        font-family: var(--font-family-neumann);
        text-align: center;
        padding: 0;
        height: auto;
        line-height: 44px;
        margin: 0;
        font-weight: var(--font-weight-btn-navigation);
        @media (max-width: 830px) {
            margin: 0 0 20px 0;
        }
        @media (max-width: 420px) {
            font-size: 37px;
        }
    }
    .conteaner-page {
        max-width: 100%;
        height: auto;
        padding: 20px;
        font-family: var(--font-family-times);
        box-sizing: border-box;
        background-color: #fafafa;
        margin-top: 30px;
    }
}
</style>
