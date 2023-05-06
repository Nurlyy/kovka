<template>
  <div class="wrapper-footer">
    <div class="footer">
      <span class="copy">© 2023 · ООО “Ковка и Дерево”</span>
      <span>+7 992 202 57 51</span>
      <span>malkov.sergey.a@yandex.ru</span>
      <span>Россия Санкт-Петербург Петровская коса 1</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style scoped lang="scss">
.wrapper-footer {
  width:100%;
  border-top:1px solid #cccccc;
  margin-top:100px;
  height:50px;
  background-color: #fff;
  .footer {
    max-width: var(--nav-max-width);
    height: var(--nav-height);
    padding: var(--nav-padding);
    box-sizing: border-box;
    margin: 10px auto;
    .copy {
      float:left;
      height:var(--span-navigation);
      color:var(--color-black);
      font-weight: var(--font-weight-btn-navigation);
      font-family: var(--font-family);
      font-size: var(--font-size-span-navigation);
      padding:var(--padding-span-navigation);
      box-sizing: border-box;
      border-right:0 !important;
      margin-top:3px;
    }
    span {
      float:right;
      height:var(--span-navigation);
      color:var(--color-black);
      font-weight: var(--font-weight-btn-navigation);
      font-family: var(--font-family);
      font-size: var(--font-size-span-navigation);
      padding:var(--padding-span-navigation);
      box-sizing: border-box;
      border-right:var(--span-border-navigation);
      margin-top:3px;
      &:nth-child(2) {
        padding: var(--padding-span-child-navigation);
        border-right: none !important;
        font-family: var(--font-span-child-navigation);
        font-size: var(--fontsize-span-child-navigation);
      }
      &:nth-child(4) {
        color: var(--color-lastspan-child-navigation);
      }
    }
  }
}
</style>
