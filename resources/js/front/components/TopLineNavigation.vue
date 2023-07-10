<template>
    <div class="top-line-navigation">
        <nav>
            <a href="/"><img src="@/front/assets/images/PNG-logo-mini.png" alt="Ковка и Дерево" class="logo-mini"></a>
            <a href="/page/contact" class="contacts-btn">Контакты</a>
            <!-- <a href="/blog" style="margin-left: 10px;" class="contacts-btn">Блог</a> -->
            <span>{{number}}</span>
            <span>{{email}}</span>
            <span>{{address}}</span>
        </nav>
    </div>
</template>

<script>
export default {
    name: "TopLineNavigation",
    data(){
        return {
            email: null,
            number: null,
            address: null,
        }
    },
    mounted() {
        axios.post("/api/get-contacts", {}).then((response) => {
            this.number = response.data.contacts.phone_number;
            this.email = response.data.contacts.email;
            this.address = response.data.contacts.address;
        });
    },
};
</script>

<style scoped lang="scss">
.top-line-navigation {
  position: sticky;
  position: -webkit-sticky;
  height: var(--top-navigation-height);
  width:var(--top-navigation-width);
  top:0;
  z-index: 4;
  background-color: var(--top-navigation-background-color);
  -webkit-box-shadow: var(--top-navigation-shadow);
  -moz-box-shadow: var(--top-navigation-shadow);
  box-shadow: var(--top-navigation-shadow);
  padding-top: var(--top-navigation-paddin);
  box-sizing: border-box;
  @media (max-width: 780px) {
    padding-top: 0;
    height: 64px;
  }
  nav {
    max-width: var(--nav-max-width);
    height: var(--nav-height);
    padding: var(--nav-padding);
    box-sizing: border-box;
    margin: 0 auto;
    .logo-mini {
      float:left;
      width:66px;
      margin-right: 15px;
      @media (max-width: 900px) {
        display: none;
      }
    }
    .contacts-btn {
      float:left;
      height:var(--height-btn-navigation);
      border:var(--border-btn-navigation);
      text-decoration: none;
      padding:var(--padding-btn-navigation);
      box-sizing: border-box;
      border-radius: var(--radius-btn-navigation);
      color: var(--color-btn-navigation);
      font-size: var(--font-size-btn-navigation);
      font-weight: var(--font-weight-btn-navigation);
      font-family: var(--font-family-btn-navigation);
      transition: var(--transition);
      &:hover {
        border-color:var(--color-hover-btn-navigation);
      }
      @media (max-width: 780px) {
        margin-top:16px;
      }
    }
    span {
      float:right;
      height:var(--span-navigation);
      color:var(--color-white);
      font-weight: var(--font-weight-btn-navigation);
      font-family: var(--font-family);
      font-size: var(--font-size-span-navigation);
      padding:var(--padding-span-navigation);
      box-sizing: border-box;
      border-right:var(--span-border-navigation);
      margin-top:3px;
      &:nth-child(3) {
        padding: var(--padding-span-child-navigation);
        border-right: none !important;
        font-family: var(--font-span-child-navigation);
        font-size: var(--fontsize-span-child-navigation);
      }
      &:nth-child(4) {
        color: var(--color-lastspan-child-navigation);
      }
      @media (max-width: 780px) {
        border-right: none !important;
        padding:9px 20px 0 0;
        &:nth-child(3) {
          padding: 6px 0 0 0;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: var(--fontsize-span-child-navigation);
        }
        &:nth-child(4) {
          float:right;
          padding-left:0px;
        }
        &:nth-child(5) {
          float:right;
          width:320px !important;
          padding:5px 0 0 0;
          width:auto;
          text-align: right;
          border-right: none !important;
        }
      }
      @media (max-width: 450px) {
        border-right: none !important;
        font-size:12px;
        width:100%;
        text-align: right;
        &:nth-child(3) {
          display: block !important;
          float:none;
          padding: 13px 0 0 0;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: 16px;
        }
        &:nth-child(4) {
          display: block !important;
          float:none;
          padding: 6px 0 0 20px;
          border-right: none !important;
          font-size: 13px;
        }
        &:nth-child(5) {
          display: none;
          padding:3px 0 0 0;
          border-right: none !important;
        }
      }
    }
  }
}
</style>
