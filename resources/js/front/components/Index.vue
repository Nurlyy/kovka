<template>
    <TopLineNavigation />
    <div class="mine-conteaner">
        <Header :title='title' :body='body' />
        <Gallery />
        <CallMe />
        <Team v-if="teamVisibility" />
        <Regalia />
        
    </div>
    <Footer />
</template>

<script>
import TopLineNavigation from "./TopLineNavigation.vue";
import Header from "./Header.vue";
import Gallery from "./Gallery.vue";
import CallMe from "./CallMe.vue";
import Regalia from "./Regalia.vue";
import Footer from "./Footer.vue";
import Team from './Team.vue';

export default {
    name: "Index",
    components: {
        TopLineNavigation,
        Header,
        Gallery,
        CallMe,
        Regalia,
        Footer,
        Team,
    },
    data(){
        return{
            teamVisibility: false,
            title: '',
            body: '',
        }
    },
    methods: {
        getMainPage() {
            axios.post("/api/get-main-page").then((response) => {
                this.title = response.data.mainPage.title;
                this.body = response.data.mainPage.body;
            });
        },
    },
    mounted(){
        axios.post('/api/get-personal-status').then((response) => {
            this.teamVisibility = response.data.visibility;
        });
        axios.post('/api/get-main-page').then((response) => {
            const description = response.data.mainPage.description;
            document.querySelector('meta[name="description"]').setAttribute('content', description);
        });
        this.getMainPage();
    }
};
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
@import url('https://fonts.cdnfonts.com/css/neumann');

body {
  margin:0;
  padding:0;
}
#app {
  width:var(--width-main);
  min-width: 380px;
  height:var(--height-main);
  background-color:var(--background-color);
  background-image: var(--background-img);
  background-position: top center;
}
:root {
  --width-main: 100%;
  --width-height: 100%;
  --background-color: none;

  --transition: .3s;

  --color-white: #fff;
  --color-purple-h2: #412b57;

  --font-family:'Georgia', serif;
  --font-family-neumann:'Playfair Display', sans-serif;
  --font-family-times:'Georgia', serif;

  --font-saze-h1: 44px;
  --font-saze-h2: 30px;
  --font-saze-p-mine: 18px;
  --font-saze-p-gallery: 18px;

  // TopLineNavigation
  --top-navigation-height: 54px;
  --top-navigation-width:100%;
  --top-navigation-background-color: #201c2b;
  --top-navigation-shadow: 0px 4px 36px 0px rgba(34, 60, 80, 0.3);
  --top-navigation-paddin:11px;
  --nav-max-width: 1140px;
  --nav-height:32px;
  --nav-padding:0 20px;

  --font-family-btn-navigation:'Georgia', serif;
  --font-weight-btn-navigation:400;
  --font-size-btn-navigation:13px;
  --color-btn-navigation:#fff;
  --color-hover-btn-navigation:#201c2b;
  --height-btn-navigation: 32px;
  --padding-btn-navigation: 5px 0;
  --radius-btn-navigation: 8px;
  --border-btn-navigation:3px solid #201c2b;
  --font-size-span-navigation:14px;
  --span-navigation:26px;
  --span-border-navigation:1px solid #44414d;
  --padding-span-navigation: 5px 18px;
  --padding-span-child-navigation:1px 0 0 18px !important;
  --font-span-child-navigation: 'Georgia', serif !important;
  --fontsize-span-child-navigation: 19px !important;
  --color-lastspan-child-navigation: #a8a8a8 !important;

}
.mine-conteaner {
  max-width: var(--nav-max-width);
  padding: var(--nav-padding);
  box-sizing: border-box;
  margin: 0 auto;
}
</style>