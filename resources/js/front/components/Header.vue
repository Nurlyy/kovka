<template>
  <div class="header">
    <div class="conteaner-logo">
      <a href="/" aria-label="Main Logo" class="logo">
        <img src="@/front/assets/images/logo.png" alt="">
      </a>
    </div>
    <h1>
        {{ title }}
    </h1>
    <p v-html="body">
    </p>
  </div>
</template>

<script>
export default {
  name: 'Header',
  data() {
    return {
        header: null,
        title: null,
        body: null,
    }
  },
  mounted(){
    this.getMainPage();
  },
  methods:{
    getMainPage(){
        axios.post('/api/get-main-page').then((response) => {
            this.header = response.data.mainPage.header;
            this.title = response.data.mainPage.title;
            this.body = response.data.mainPage.body;
            document.title = this.header;
        })
    }
  }
}
</script>

<style scoped lang="scss">
.header {
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
  p {
    width:100%;
    color:#3b3b3b;
    font-size: var(--font-saze-p-mine);
    line-height: 22px;
    font-family: var(--font-family-times);
    text-align: center;
    padding:10px 3% 60px;
    margin:0;
    box-sizing: border-box;
  }
}
</style>
