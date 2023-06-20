<!-- <template>
    <div class="regalia">
        <a
            v-for="(regalia, index) in regalias"
            :href="pages_slugs[regalia.id]"
            class="conteaner-card"
            :key="index"
            :aria-label='regalia.title'
        >
            <div class="conteanet-ico card-1-ico">
                <img :src="regalia.image" alt="" />
            </div>
            <h4>{{ regalia.title }}</h4>
            <hr />
            <p>{{ regalia.body }}</p>
        </a>
    </div>
</template> -->

<template>
    <div class="regalia">
        <div
            v-for="(regalia, index) in regalias"
            :href="pages_slugs[regalia.id]"
            class="conteaner-card"
            :key="index"
            :aria-label="regalia.title"
            :style="{ backgroundImage: 'url(' + regalia.bg_image + ')' }"
        >
            <div class="conteanet-ico">
                <img :src="regalia.image" alt="" />
            </div>
            <h4>{{ regalia.title }}</h4>
            <p>{{ regalia.body }}</p>
            <a :href="pages_slugs[regalia.id]" class="btn-regalia-more"
                >Подробнее</a
            >
        </div>
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
            axios.post("/api/get-pages").then((res) => {
                if (res.data.items) {
                    this.pages = res.data.items;
                    var temp = [];
                    this.pages.forEach((page) => {
                        temp[page.id] = page;
                    });
                    this.pages = temp;
                    this.regalias.forEach((regalia) => {
                        this.pages_slugs[regalia.id] = this.pages[
                            regalia.page_id
                        ]
                            ? "/page/" + this.pages[regalia.page_id].slug
                            : "#";
                    });
                }
            });
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
        position: relative;
        background-color: #fafafa;
        height: auto;
        padding: 0 0 70px 0;
        text-decoration: none;
        transition: var(--transition);
        background-repeat: no-repeat;
        background-position: right -80px top -40px;
        background-size: 300px;
        text-align: left;
        &:hover {
            background-color: #f7f7f7;
            p {
                color: #412b5f !important;
            }
        }
        .conteanet-ico {
            position: relative;
            margin: 30px 0 20px 30px;
            width: 33px;
            height: 40px;
            // height:auto;
            text-align: left;
            box-sizing: border-box;
            img {
                object-fit: contain;
                width: 100%;
                height: 100%;
            }
        }
        h4 {
            display: block;
            padding: 0 14px 0 30px;
            box-sizing: border-box;
            text-align: left;
            width: var(--width-main);
            color: #000;
            font-size: 16px;
            font-family: 'Playfair Display', arial;
            font-weight: normal;
            min-height: 50px;
            margin: 0 0 12px 0;
        }
        p {
            max-width: 100%;
            color: #969696;
            font-size: 14px !important;
            line-height: 22px;
            font-family: var(--font-family-times) !important;
            text-align: left;
            padding: 0 30px 0 30px;
            margin: 0;
            box-sizing: border-box;
            transition: var(--transition);
        }
        .btn-regalia-more {
            position: absolute;
            bottom: 30px;
            left: 30px;
            display: block;
            width: min-content;
            // border:1px solid #cccccc;
            text-decoration: underline;
            color: #969696;
            font-size: 14px !important;
            line-height: 22px;
            font-family: var(--font-family-times) !important;
            text-align: left;
            box-sizing: border-box;
            transition: var(--transition);
            color: #412b5f;
        }
    }
}
</style>
