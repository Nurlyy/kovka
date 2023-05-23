<template>
    <Carousel v-bind="settings" :breakpoints="breakpoints">
      <Slide v-for="person, index in personal" :key="index">
        <!-- <div class="carousel__item">{{ slide }}</div> -->
        <div class="conteaner-card-team">
          <div class="conteaner-photo-team">
            <img :src='person.image'>
          </div>
          <p class="name">
            {{person.name}}
          </p>
          <p class="post">
            {{person.position}}
          </p>
          <p class="email">
            {{person.email}}
          </p>
          <p class="info">
            {{ person.body }}
        </p>
        </div>
      </Slide>
      <template #addons>
        <Navigation />
      </template>
    </Carousel>
  </template>
  
  <script>
  import 'vue3-carousel/dist/carousel.css'
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
  
  export default {
    name: 'Team',
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
    },
    data: () => ({
      // carousel settings
      settings: {
        itemsToShow: 1,
        snapAlign: 'start',
      },
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 3,
          snapAlign: 'start',
        },
        // 1024 and up
        1024: {
          itemsToShow: 4,
          snapAlign: 'start',
        },
      },
      personal: null,
    }),
    methods: {
        getPersonal(){
            axios.post('/api/get-personal').then((response) => {
                this.personal = response.data.personal;
            })
        }
    },
    mounted(){
        this.getPersonal();
    }
  }
  </script>
  
  <style lang="scss">
  .carousel {
    width: calc(100% + 6px);
    margin-left:-3px;
  }
  .carousel__track {
    padding: 0px !important;
    margin: 6px 0 0 0 !important;
    display: flex !important;
    flex-wrap: nowrap;
    gap: 0 !important;
  }
  .conteaner-card-team {
    background-color: #fafafa;
    height:auto;
    padding: 0;
    text-decoration: none;
    width:100%;
    height:auto;
    margin:0 3px;
    min-height: 400px;
    box-sizing: border-box;
    text-align: center !important;
    .conteaner-photo-team {
      position: relative;
      width:100%;
      height:300px;
      background-color: #d3d3d3;
      overflow: hidden;
      margin-bottom:16px;
      img {
        width:100%;
        height:100%;
        border:0;
        object-fit: cover;
      }
    }
    .name {
      width:100%;
      height:auto;
      overflow: hidden;
      color: #111;
      font-size: 16px;
      font-family: var(--font-family);
      font-weight: 500;
      margin:0 !important;
      padding: 0 20px 4px 20px !important;
      box-sizing: border-box;
    }
    .post {
      width:100%;
      height:auto;
      overflow: hidden;
      color: #111;
      font-size: 13px;
      font-family: var(--font-family);
      font-weight: 400;
      margin:0 !important;
      padding: 0 20px 20px 20px !important;
      box-sizing: border-box;
    }
    .email {
      width:100%;
      height:auto;
      overflow: hidden;
      color: #111;
      font-size: 13px;
      font-family: var(--font-family);
      font-weight: 400;
      margin:0 !important;
      padding: 0 20px 3px 20px !important;
      box-sizing: border-box;
    }
    .info {
      width:100%;
      height:auto;
      overflow: hidden;
      color: #949494;
      font-size: 15px;
      font-family: var(--font-family-times);
      font-weight: 400;
      margin:15px 0 0 0 !important;
      padding: 0 20px 20px 20px !important;
      font-style: italic;
      line-height: 20px;
    }
  }
  // .team {
  //   position: relative;
  //   max-width:100%;
  //   display: grid;
  //   margin-top:6px;
  //   grid-template-columns: repeat(4, 1fr);
  //   grid-template-rows: auto;
  //   gap:6px;
  //   @media (max-width: 830px) {
  //     grid-template-columns: repeat(2, 1fr);
  //   }
  //   .conteaner-card {
  //     background-color: #fafafa;
  //     height:auto;
  //     padding: 0 0 30px 0;
  //     text-decoration: none;
  //     transition: var(--transition);
  //     &:hover {
  //       background-color: #f7f7f7;
  //       p {
  //         color:#412b5f !important;
  //       }
  //     }
  //     .conteanet-ico {
  //       position: relative;
  //       margin: 35px auto 30px;
  //       width:112px;
  //       height:112px;
  //       border-radius: 112px;
  //       background-color: #fff;
  //       text-align: center;
  //       box-sizing: border-box;
  //       &.card-1-ico {
  //         padding: 24px 0 0 0;
  //       }
  //       &.card-2-ico {
  //         padding: 29px 0 0 0;
  //       }
  //       &.card-3-ico {
  //         padding: 28px 0 0 0;
  //       }
  //       &.card-4-ico {
  //         padding: 35px 0 0 0;
  //       }
  //     }
  //     h4 {
  //       display: block;
  //       padding: 0;
  //       margin: 0;
  //       text-align: center;
  //       width:var(--width-main);
  //       color:#000;
  //       font-size: 16px;
  //       font-family: var(--font-family-neumann);
  //       font-weight: normal;
  //     }
  //     hr {
  //       width:65px;
  //       height:1px;
  //       border:0;
  //       background: rgb(65,43,87);
  //       background: radial-gradient(circle, rgba(65,43,87,1) 0%, rgba(250,250,250,0) 100%);
  //       margin-top:18px;
  //     }
  //     p {
  //       max-width:210px;
  //       color:#969696;
  //       font-size: 14px !important;
  //       line-height: 22px;
  //       font-family: var(--font-family-times) !important;
  //       text-align: center;
  //       padding:5px 15px;
  //       margin:0 auto;
  //       box-sizing: border-box;
  //       transition: var(--transition);
  //     }
  //   }
  // }
  </style>
  