<template>
  <div class="header">
    <div class="conteaner-logo">
      <a href="" class="logo">
        <img src="@/assets/images/logo.png" alt="">
      </a>
    </div>
    <h1>
      Летняя коллекция мебели для дома и улицы на заказ
    </h1>
    <p>
      Кованая мебель - популярный пример применения художественной ковки в интерьере и экстерьере. Скамьи, качели, летние беседки, перголы, столы и стулья, зоны для барбекю, арки и калитки - все они могут быть изготовлены из кованого металла и использованы как внутри дома, так и на улице. 
    </p>
  </div>
</template>

<script>
export default {
  name: 'Header'
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
