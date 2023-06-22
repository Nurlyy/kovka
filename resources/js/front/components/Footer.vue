<!-- <template>
    <div class="wrapper-footer">
        <div class="footer">
            <span class="copy">© 2023 · ООО “Ковка и Дерево”</span>
            <span>{{ number }}</span>
            <span>{{ email }}</span>
            <span>{{ address }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            email: null,
            number: null,
            address: null,
        };
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
.wrapper-footer {
    width: 100%;
    border-top: 1px solid #cccccc;
    margin-top: 100px;
    height: 50px;
    background-color: #fff;
    .footer {
        max-width: var(--nav-max-width);
        height: var(--nav-height);
        padding: var(--nav-padding);
        box-sizing: border-box;
        margin: 10px auto;
        @media (max-width: 830px) {
            height: 72px;
        }
        .copy {
            float: left;
            height: var(--span-navigation);
            color: var(--color-black);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: var(--font-size-span-navigation);
            padding: var(--padding-span-navigation);
            box-sizing: border-box;
            border-right: 0 !important;
            margin-top: 3px;
            @media (max-width: 830px) {
                margin-top: 19px;
            }
        }
        span {
            float: right;
            height: var(--span-navigation);
            color: var(--color-black);
            font-weight: var(--font-weight-btn-navigation);
            font-family: var(--font-family);
            font-size: var(--font-size-span-navigation);
            padding: var(--padding-span-navigation);
            box-sizing: border-box;
            border-right: var(--span-border-navigation);
            margin-top: 3px;
            &:nth-child(2) {
                padding: var(--padding-span-child-navigation);
                border-right: none !important;
                font-family: var(--font-span-child-navigation);
                font-size: var(--fontsize-span-child-navigation);
            }
            &:nth-child(4) {
                color: var(--color-lastspan-child-navigation);
            }
            @media (max-width: 830px) {
                border-right: none !important;
                padding: 9px 20px 0 0;
                &:nth-child(2) {
                    padding: 6px 0 0 0;
                    border-right: none !important;
                    font-family: var(--font-span-child-navigation);
                    font-size: var(--fontsize-span-child-navigation);
                }
                &:nth-child(4) {
                    display: block;
                    padding: 5px 0 0 20px;
                    border-right: none !important;
                }
            }
        }
    }
}
</style> -->





<template>
    <div class="wrapper-footer">
        <div class="footer">
            <span class="copy">© 2023 · ООО “Ковка и Дерево”</span>
            <span>{{ number }}</span>
            <span>{{ email }}</span>
            <span>{{ address }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            email: null,
            number: null,
            address: null,
        };
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
    @media (max-width: 830px) {
      height: 72px;
    }
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
      @media (max-width: 830px) {
        margin-top:19px;
      }
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
      @media (max-width: 830px) {
        border-right: none !important;
        padding:9px 20px 0 0;
        &:nth-child(2) {
          padding: 6px 0 0 0;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: var(--fontsize-span-child-navigation);
        }
        &:nth-child(4) {
          display: block;
          padding:5px 0 0 20px;
          border-right: none !important;
        }
      }
      @media (max-width: 660px) {
        border-right: none !important;
        padding:9px 20px 0 0;
        &:nth-child(1) {
          height:var(--span-navigation);
          color:var(--color-black);
          font-weight: var(--font-weight-btn-navigation);
          font-family: var(--font-family);
          font-size: var(--font-size-span-navigation);
          padding:var(--padding-span-navigation);
          box-sizing: border-box;
          border-right:var(--span-border-navigation);
          margin-top:3px;
        }
        &:nth-child(2) {
          padding: 0px 0 0 10px;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: var(--fontsize-span-child-navigation);
        }
        &:nth-child(3) {
          padding: 5px 0 0 30px;
          border-right: none !important;
        }
        &:nth-child(4) {
          display: block;
          float:left;
          padding:5px 0 0 20px;
          border-right: none !important;
        }
      }
      @media (max-width: 580px) {
        border-right: none !important;
        padding:9px 0 0 30px;
        &:nth-child(1) {
          height:var(--span-navigation);
          color:var(--color-black);
          font-weight: var(--font-weight-btn-navigation);
          font-family: var(--font-family);
          font-size: var(--font-size-span-navigation);
          padding:var(--padding-span-navigation);
          box-sizing: border-box;
          border-right:var(--span-border-navigation);
          margin-top:3px;
        }
        &:nth-child(2) {
          padding: 0px 0 0 10px;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: var(--fontsize-span-child-navigation);
        }
        &:nth-child(3) {
          padding: 5px 0 0 30px;
          border-right: none !important;
        }
        &:nth-child(4) {
          display: block;
          float:left;
          padding:5px 0 0 20px;
          border-right: none !important;
        }
      }
      @media (max-width: 500px) {
        border-right: none !important;
        &:nth-child(1) {
          height:var(--span-navigation);
          color:var(--color-black);
          font-weight: var(--font-weight-btn-navigation);
          font-family: var(--font-family);
          font-size: var(--font-size-span-navigation);
          padding:var(--padding-span-navigation);
          box-sizing: border-box;
          border-right:var(--span-border-navigation);
          margin-top:3px;
          float:none;
          padding: 0 0 0 0 !important;
        }
        &:nth-child(2) {
          position:relative;
          padding: 15px 0 0 0;
          display: block;
          float:none;
          border-right: none !important;
          font-family: var(--font-span-child-navigation);
          font-size: var(--fontsize-span-child-navigation);
        }
        &:nth-child(3) {
          position:relative;
          padding: 20px 0 0 0;
          border-right: none !important;
          display: block;
          float:none;
        }
        &:nth-child(4) {
          position:relative;
          display: block;
          float:none;
          padding:20px 0 35px 0;
          border-right: none !important;
        }
      }
    }
  }
}
</style>
