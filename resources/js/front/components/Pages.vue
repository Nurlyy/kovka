<template>
    <TopLineNavigation />
    <div class="page">
        <div class="conteaner-logo">
            <a href="/" class="logo">
                <img src="@/front/assets/images/logo.png" alt="" />
            </a>
        </div>
        <div class="conteaner-page">
            <div class="wrapper">
                <h1>
                    {{ page.title }}
                </h1>

                <div v-html="page.body"></div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from "./TopLineNavigation.vue";
import Footer from "./Footer.vue";
export default {
    name: "Page",
    components: {
        TopLineNavigation,
        Footer,
    },
    data() {
        return {
            page: {
                title: "",
                body: "",
                
            },
        };
    },
    mounted() {
        const slug = this.$route.params.slug;
        axios.post("/api/get-page", { slug: slug }).then((response) => {
            this.page = response.data.page;
            document.title = this.page.header_title;
            // console.log(response.data);
        });
    },
};
</script>

<style lang="scss">
.conteaner-page {
    max-width: 1100px;
    position: relative;
    height: auto;
    padding: 20px;
    font-family: var(--font-family-times);
    box-sizing: border-box;
    background-color: #fafafa;
    margin: 30px auto;
    font-size: 18px !important;
    line-height: 24px !important;
    .wrapper {
        position: relative;
        max-width: 700px;
        margin: 0 auto;
        h2,
        h3,
        h4,
        h5,
        p {
            font-family: var(--font-family-times) !important;
            font-weight: normal;
        }
        h1 {
            border-bottom: 1px solid #e7e7e7 !important;
            padding: 20px 0 40px !important;
            display: block !important;
            max-width: 700px !important;
            margin: 0 auto !important;
            width: var(--width-main) !important;
            color: var(--color-purple-h2) !important;
            font-size: var(--font-saze-h2) !important;
            font-family: var(--font-family-neumann) !important;
            font-weight: 400 !important;
            text-align: left !important;
        }
        blockquote {
            padding: 0 20px !important;
            margin: 0;
            border: 3px solid #44414d;
            border-radius: 8px;
            box-sizing: border-box;
            background: #fff;
        }
        ul {
            padding: 0;
            list-style: none;
            counter-reset: li;
        }
        ul li {
            position: relative;
            border-left: 4px solid #dddddd;
            padding: 16px 20px 16px 28px;
            margin: 12px 0 12px 80px;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
        }
        ul li:before {
            line-height: 32px;
            position: absolute;
            top: 10px;
            left: -80px;
            width: 80px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #dddddd;
            counter-increment: li;
            content: counter(li);
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        ul li:hover:before {
            color: #77aedb;
        }
        ul li:after {
            position: absolute;
            top: 26px;
            left: -40px;
            width: 60px;
            height: 60px;
            border: 8px solid #3399ff;
            border-radius: 50%;
            content: "";
            opacity: 0;
            -webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
            -moz-transition: -moz-transform 0.3s, opacity 0.3s;
            transition: transform 0.3s, opacity 0.3s;
            -webkit-transform: translateX(-50%) translateY(-50%) scale(0.1);
            -moz-transform: translateX(-50%) translateY(-50%) scale(0.1);
            transform: translateX(-50%) translateY(-50%) scale(0.1);
            pointer-events: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        ul li:hover:after {
            opacity: 0.2;
            -webkit-transform: translateX(-50%) translateY(-50%) scale(1);
            -moz-transform: translateX(-50%) translateY(-50%) scale(1);
            transform: translateX(-50%) translateY(-50%) scale(1);
        }
    }
}
</style>

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
        max-width: 1100px;
        height: auto;
        padding: 20px;
        font-family: var(--font-family-times);
        box-sizing: border-box;
        background-color: #fafafa;
        margin: 30px auto;
    }
}
