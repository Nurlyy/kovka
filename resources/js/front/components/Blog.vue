<template>
    <TopLineNavigation />
    <div class="blog">
        <div class="conteaner-logo">
            <a href="/" class="logo">
                <img src="@/front/assets/images/logo.png" alt="" />
            </a>
        </div>
        <h1>Дизайнерские новинки и другие материалы</h1>
        <div class="wrapper">
            <div class="conteaner-blog">
                <div
                    class="blog-card"
                    v-for="(blog, index) in blogs"
                    :key="index"
                >
                    <div class="conteaner-img">
                        <img :src="blog.preview_image" alt="" />
                    </div>
                    <a :href="'/page/' + blog.slug" class="link-card">
                        <span class="readings"> {{ blog.views }} </span>
                        <span>
                            {{ blog.preview_body }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from "./TopLineNavigation.vue";
import Footer from "./Footer.vue";
export default {
    name: "Blog",
    components: {
        TopLineNavigation,Footer
    },
    data() {
        return {
            blogs: [],
        };
    },
    methods: {
        getBlogs() {
            axios.post("/api/get-blogs").then((response) => {
                this.blogs = response.data.blogs;
            });
        },
    },
    mounted() {
        this.getBlogs();
    },
};
</script>

<style scoped lang="scss">
.blog {
    .wrapper {
        max-width: 1100px !important;
        margin-left:auto;
        margin-right: auto;
    }
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
        margin: 0 0 50px 0;
        font-weight: var(--font-weight-btn-navigation);
        @media (max-width: 830px) {
            margin: 0 0 20px 0;
        }
        @media (max-width: 420px) {
            font-size: 37px;
        }
    }
    .conteaner-blog {
        position: relative;
        max-width: 1100px !important;
        display: grid;
        margin-top: 6px;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: auto;
        gap: 6px;
        @media (max-width: 830px) {
            grid-template-columns: repeat(2, 1fr);
        }
        .blog-card {
            position: relative;
            background-color: #fff;
            transition: var(--transition);
            box-sizing: border-box;
            .conteaner-img {
                position: relative;
                width: 100%;
                height: 370px;
                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .link-card {
                display: block;
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: rgba(0, 0, 0, 0.45);
                z-index: 3;
                transition: var(--transition);
                .readings {
                    position: absolute;
                    top: 0;
                    box-sizing: border-box;
                    padding: 20px 0 0 48px;
                    font-size: 14px;
                    color: #fff;
                    font-family: var(--font-family-times);
                    font-weight: normal;
                    background-image: url(@/front/assets/images/eye.svg);
                    background-repeat: no-repeat;
                    background-position: left 20px top 17px;
                    background-size: 20px;
                }
                span {
                    position: absolute;
                    bottom: 0;
                    box-sizing: border-box;
                    padding: 20px;
                    font-size: 22px;
                    color: #fff;
                    font-family: var(--font-family-times);
                    font-weight: normal;
                }
                &:hover {
                    background-color: rgba(0, 0, 0, 0.1);
                }
            }
        }
    }
}
</style>
