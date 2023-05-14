<template>
    <div class="regalia">
        <a
            v-for="(regalia, index) in regalias"
            :href='pages_slugs[regalia.id]'
            class="conteaner-card"
            :key="index"
        >
            <div class="conteanet-ico card-1-ico">
                <img :src="regalia.image" alt="" />
            </div>
            <h4>{{ regalia.title }}</h4>
            <hr />
            <p>{{ regalia.body }}</p>
        </a>
        <!-- <a href="#" class="conteaner-card">
        <div class="conteanet-ico card-2-ico">
          <img src="@/assets/images/card-2.png" alt="">
        </div>
        <h4>
          Удобное местоположение
        </h4>
        <hr>
        <p>
          Найти нас очень просто, мы находимся в сам центре Санкт-Петербурга
        </p>
      </a>
      <a href="#" class="conteaner-card">
        <div class="conteanet-ico card-3-ico">
          <img src="@/assets/images/card-3.png" alt="">
        </div>
        <h4>
          Современный станочный парк
        </h4>
        <hr>
        <p>
          Для производства мебели из массива дерева и художественного паркета.
        </p>
      </a>
      <a href="#" class="conteaner-card">
        <div class="conteanet-ico card-4-ico">
          <img src="@/assets/images/card-4.png" alt="">
        </div>
        <h4>
          Услуги
        </h4>
        <hr>
        <p>
          Мы всегда рады сотрудничать с дизайнерами и архитекторами
        </p>
      </a> -->
    </div>
</template>

<script>
export default {
    name: "Regalia",
    data() {
        return {
            regalias: null,
            pages: [],
            pages_slugs: {},
        };
    },
    mounted() {
        axios.post("/api/get-regalia").then((response) => {
            this.regalias = response.data.regalia;
        });
        axios.post("/api/get-pages").then((response) => {
            if (response.data.items) {
                this.pages = response.data.items;
                this.regalias.forEach(regalia => {
                    this.pages_slugs[regalia.id] = this.pages.map(function (page) {
                        if(page.id == regalia.page_id){
                            return '/page/' + page.slug;
                        }else{
                            return "#";
                        }
                    })
                })
                
            }
        });
    },
};
</script>

<style scoped lang="scss">
.regalia {
    position: relative;
    max-width: 100%;
    display: grid;
    margin-top: 6px;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: auto;
    gap: 6px;
    @media (max-width: 830px) {
        grid-template-columns: repeat(2, 1fr);
    }
    .conteaner-card {
        background-color: #fafafa;
        height: auto;
        padding: 0 0 30px 0;
        text-decoration: none;
        transition: var(--transition);
        &:hover {
            background-color: #f7f7f7;
            p {
                color: #412b5f !important;
            }
        }
        .conteanet-ico {
            position: relative;
            margin: 35px auto 30px;
            width: 112px;
            height: 112px;
            border-radius: 112px;
            background-color: #fff;
            text-align: center;
            box-sizing: border-box;
            &.card-1-ico {
                padding: 24px 0 0 0;
            }
            &.card-2-ico {
                padding: 29px 0 0 0;
            }
            &.card-3-ico {
                padding: 28px 0 0 0;
            }
            &.card-4-ico {
                padding: 35px 0 0 0;
            }
        }
        h4 {
            display: block;
            padding: 0;
            margin: 0;
            text-align: center;
            width: var(--width-main);
            color: #000;
            font-size: 16px;
            font-family: var(--font-family-neumann);
            font-weight: normal;
        }
        hr {
            width: 65px;
            height: 1px;
            border: 0;
            background: rgb(65, 43, 87);
            background: radial-gradient(
                circle,
                rgba(65, 43, 87, 1) 0%,
                rgba(250, 250, 250, 0) 100%
            );
            margin-top: 18px;
        }
        p {
            max-width: 210px;
            color: #969696;
            font-size: 14px !important;
            line-height: 22px;
            font-family: var(--font-family-times) !important;
            text-align: center;
            padding: 5px 15px;
            margin: 0 auto;
            box-sizing: border-box;
            transition: var(--transition);
        }
    }
}
</style>
