<!-- <template>
    <TopLineNavigation />
    <Header :title='page.title' :body='page.subtitle' />
    <div class="conteaner-page">
        <hr />
        <div v-html="page.body"></div>
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from "./TopLineNavigation.vue";
import Footer from "./Footer.vue";
import Header from "./Header.vue";
export default {
    name: "Page",
    components: {
        TopLineNavigation,
        Footer,
        Header,
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
        var isPreview = false;
        const slug = this.$route.params.slug;
        axios.post("/api/get-page", { slug: slug }).then((response) => {
            this.page = response.data.page;
            document.title = this.page.header_title;
            isPreview = response.data.page.isPreview == 1 ? true : false;
            const description = this.page.description;
            document
                .querySelector('meta[name="description"]')
                .setAttribute("content", description);
            // console.log(response.data.page);
            if (isPreview) {
                axios.post("/api/view-page", { page_id: this.page.id });
            }
        });
    },
};
</script>

<style lang="scss">
.conteaner-page {
  max-width: 1100px !important;
  position: relative !important;
  height:auto !important;
  padding: 0 20px 20px 20px !important;
  font-family: var(--font-family-times) !important;
  box-sizing: border-box !important;
  background-color: #fff !important;
  margin:10px auto !important;
  font-size: 18px !important;
  line-height: 24px !important;
  hr {
    padding: 0;
    width:100%;
    max-width: 400px;
    border:0;
    background-color: #dfdfdf;
    height:2px;
    margin:0 auto 50px;
  }
  .wrapper {
    position: relative;
    max-width: 700px;
    margin:0 auto;
    .conteaner-breadcrumbs {
      width:100%;
      height:auto;
      height:40px;
      margin-top:20px;
      .back-btn {
        float:left;
        height:var(--height-btn-navigation);
        border:var(--border-btn-navigation);
        text-decoration: none;
        padding:2px 10px 0 25px;
        box-sizing: border-box;
        border-radius: var(--radius-btn-navigation);
        color: #4f4f4f;
        font-size: var(--font-size-btn-navigation);
        font-weight: 500 !important;
        font-family: var(--font-family-btn-navigation);
        transition: var(--transition);
        background-image: url(@/front/assets/arrow.svg);
        background-repeat: no-repeat;
        background-position: left 0px center;
        background-size: 24px;
        &:hover {
          border-color:var(--color-hover-btn-navigation);
        }
      }
    }
  h2, h3, h4, h5, p {
    font-family: var(--font-family-times) !important;
  }
  h1 {
    border-bottom: 1px solid #e7e7e7 !important;
    padding: 20px 0 40px !important;
    display: block !important;
    max-width: 700px !important;
    margin: 0 auto 20px !important;
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
    padding:0;
    list-style: none;
    counter-reset: li;
  }    
  ul li {
    position: relative;
    border-left: 4px solid #dddddd;
    padding: 10px 20px 10px 18px;
    margin: 12px 0 12px 48px;
    -webkit-transition-duration: .3s;
    transition-duration: .3s;  
  }
  ul li:before {
    line-height: 32px;
    position: absolute;
    top: 7px;
    left: -70px;
    width: 80;
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    color: #ddd;
    counter-increment: li;
    content: counter(li);
    -webkit-transition-duration: .3s;
    transition-duration: .3s;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;       
  }
  ul li:hover:before {
    color: rgb(84, 95, 104);
  }
  ul li:after {
    position: absolute;
    top: 22px;
    left: -30px;
    width: 44px;
    height: 44px;
    border: 4px solid #44414d;
    border-radius: 12px;
    content: "";
    opacity: 0;
    -webkit-transition: -webkit-transform .3s,opacity .3s;
    -moz-transition: -moz-transform .3s,opacity .3s;
    transition: transform .3s,opacity .3s;
    -webkit-transform: translateX(-50%) translateY(-50%) scale(.1);
    -moz-transform: translateX(-50%) translateY(-50%) scale(.1);
    transform: translate(-50%) translateY(-50%) scale(.1);
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
    width:100%;
    text-align: center;
    height:auto;
    padding: 50px 0 40px;
    .logo {
      margin-left:8px;
    }
  }
  h1 {
    display: block;
    width:100%;
    color:var(--color-purple-h2);
    font-size: var(--font-saze-h1);
    font-family: var(--font-family-neumann);
    text-align: center;
    padding:0;
    height:auto;
    line-height: 44px;
    margin:0;
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
    height:auto;
    padding: 20px;
    font-family: var(--font-family-times);
    box-sizing: border-box;
    background-color: #fafafa;
    margin-top:30px;
  }
}
</style> -->








<template>
    <TopLineNavigation />
    <div class="conteaner-page">
      <Header :title='page.title' :body='page.subtitle' />
      <hr />
      <div v-html="page.body"></div>
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from "./TopLineNavigation.vue";
import Footer from "./Footer.vue";
import Header from "./Header.vue";
export default {
    name: "Page",
    components: {
        TopLineNavigation,
        Footer,
        Header,
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
        var isPreview = false;
        const slug = this.$route.params.slug;
        axios.post("/api/get-page", { slug: slug }).then((response) => {
            this.page = response.data.page;
            document.title = this.page.header_title;
            isPreview = response.data.page.isPreview == 1 ? true : false;
            const description = this.page.description;
            document
                .querySelector('meta[name="description"]')
                .setAttribute("content", description);
            // console.log(response.data.page);
            if (isPreview) {
                axios.post("/api/view-page", { page_id: this.page.id });
            }
        });
    },
};
</script>

<style lang="scss">
.conteaner-page {
  max-width: 1100px !important;
  position: relative !important;
  height:auto !important;
  padding: 0 20px 20px 20px !important;
  font-family: var(--font-family-times) !important;
  box-sizing: border-box !important;
  background-color: #fff !important;
  margin:10px auto !important;
  font-size: 18px !important;
  line-height: 24px !important;
  hr {
    padding: 0;
    width:100%;
    max-width: 400px;
    border:0;
    background-color: #dfdfdf;
    height:2px;
    margin:0 auto 50px;
  }
  .wrapper {
    position: relative;
    max-width: 700px;
    margin:0 auto;
    .conteaner-breadcrumbs {
      width:100%;
      height:auto;
      height:40px;
      margin-top:20px;
      .back-btn {
        float:left;
        height:var(--height-btn-navigation);
        border:var(--border-btn-navigation);
        text-decoration: none;
        padding:2px 10px 0 25px;
        box-sizing: border-box;
        border-radius: var(--radius-btn-navigation);
        color: #4f4f4f;
        font-size: var(--font-size-btn-navigation);
        font-weight: 500 !important;
        font-family: var(--font-family-btn-navigation);
        transition: var(--transition);
        background-image: url(@/front/assets/arrow.svg);
        background-repeat: no-repeat;
        background-position: left 0px center;
        background-size: 24px;
        &:hover {
          border-color:var(--color-hover-btn-navigation);
        }
      }
    }
  h2, h3, h4, h5, p {
    font-family: var(--font-family-times) !important;
  }
  h1 {
    border-bottom: 1px solid #e7e7e7 !important;
    padding: 20px 0 40px !important;
    display: block !important;
    max-width: 700px !important;
    margin: 0 auto 20px !important;
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
    padding:0;
    list-style: none;
    counter-reset: li;
  }    
  ul li {
    position: relative;
    border-left: 4px solid #dddddd;
    padding: 10px 20px 10px 18px;
    margin: 12px 0 12px 48px;
    -webkit-transition-duration: .3s;
    transition-duration: .3s;  
  }
  ul li:before {
    line-height: 32px;
    position: absolute;
    top: 7px;
    left: -70px;
    width: 80;
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    color: #ddd;
    counter-increment: li;
    content: counter(li);
    -webkit-transition-duration: .3s;
    transition-duration: .3s;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;       
  }
  ul li:hover:before {
    color: rgb(84, 95, 104);
  }
  ul li:after {
    position: absolute;
    top: 22px;
    left: -30px;
    width: 44px;
    height: 44px;
    border: 4px solid #44414d;
    border-radius: 12px;
    content: "";
    opacity: 0;
    -webkit-transition: -webkit-transform .3s,opacity .3s;
    -moz-transition: -moz-transform .3s,opacity .3s;
    transition: transform .3s,opacity .3s;
    -webkit-transform: translateX(-50%) translateY(-50%) scale(.1);
    -moz-transform: translateX(-50%) translateY(-50%) scale(.1);
    transform: translate(-50%) translateY(-50%) scale(.1);
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
    width:100%;
    text-align: center;
    height:auto;
    padding: 50px 0 40px;
    .logo {
      margin-left:8px;
    }
  }
  h1 {
    display: block;
    width:100%;
    color:var(--color-purple-h2);
    font-size: var(--font-saze-h1);
    font-family: var(--font-family-neumann);
    text-align: center;
    padding:0;
    height:auto;
    line-height: 44px;
    margin:0;
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
    height:auto;
    padding: 20px;
    font-family: var(--font-family-times);
    box-sizing: border-box;
    background-color: #fafafa;
    margin-top:30px;
  }
}
</style>
