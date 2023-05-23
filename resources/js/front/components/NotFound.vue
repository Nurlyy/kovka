<template>
  <div class="conteaner-page-404">
    <a href="" class="logo">
      <img src="@/front/assets/images/logo.png" alt="">
    </a>
    <p class="p-404">404</p>
    <h1>Страница не найдена</h1>
    <p class="text">Похоже, запрашиваемая Вами страница не найдена.</p>
    <p>
      <a href="/">Вернуться на главную страницу</a>
    </p>
    
  </div>
</template>

<script>
export default {
  name: '404'
}
</script>

<style scoped lang="scss">
.conteaner-page-404 {
  text-align: center;
  .logo {
    background: none !important;
    margin: 10vh auto 0 !important;
    padding:0 0 0 12px;
  }
  .p-404 {
    text-align: center;
    font-size: calc(1em + 10vw);
    color:#686868;
    font-family: Roboto;
    font-weight:200;
    padding: 0 !important;
    margin: 120px 0 0 0 !important;
  }
  h1 {
    text-align: center;
    font-size: 34px;
    color:#000;
    font-family: Roboto;
    font-weight:300;
    margin: 0 auto !important;
    max-width: 400px;
    width:auto;
    padding: 0 20px;
    box-sizing:border-box;
  }
  .text {
    text-align: center;
    font-size: 16px;
    color:#757575;
    font-family: Roboto;
    font-weight:300;
    margin: 10px auto 0 !important;
    max-width: 300px;
    width:auto;
    padding: 0 20px;
    box-sizing:border-box;
  }
  a {
    margin:40px auto 0 !important;
    display: block;
    position: relative;
    text-decoration: none;
    width:fit-content;
    background-color: #412b5f;
    outline: none;
    color:var(--color-white);
    font-weight: var(--font-weight-btn-navigation);
    font-family: var(--font-family);
    font-size: 14px;
    height:36px;
    padding: 9px 22px;
    cursor: pointer;
    box-sizing:border-box;
  }
}
</style>