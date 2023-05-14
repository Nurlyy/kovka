<template>
    <div class="gallery">
        <div class="navigation-gallery">
            <button
                v-for="(page, index) in pages"
                :key="index"
                :class="{ active: index === selectedIndex }"
                @click="galleryClick(index)"
            >
                {{ page.header }}
            </button>
        </div>
        <div id="gallery-list-photo" class="gallery-list-photo">
            <div style="position:relative;" v-for="(image, index) in images" :key="index">
                <img :src="image" alt="" id="imageImg" />
                <a
                    @click="imageClicked(image, $event)"
                    :href="image"
                    :data-pswp-width="maxWidth"
                    :data-pswp-height="maxHeight"
                    target="_blank"
                    rel="noreferrer"
                    id="imageView"
                >
                    
                </a>
            </div>
        </div>
        <div class="gallery-text" :class="maxheightClass">
            <h2>{{ title }}</h2>
            <div class="conteaner-text">
                {{ body }}
            </div>
            <div class="conteaner-hidden-botton" :class="dnoneActive">
                <div class="conteaner-gradient">
                    <button
                        @click="
                            (maxheightClass = 'maxheight'),
                                (dnoneActive = 'dnone')
                        "
                    >
                        Читать полностью
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";
export default {
    name: "Gallery",
    data() {
        return {
            gallereActive_1: true,
            gallereActive_2: false,
            gallereActive_3: false,
            active: "active",
            active2: "",
            active3: "",
            maxheightClass: "",
            dnoneActive: "",
            pages: null,
            ids: null,
            selectedIndex: -1,
            classList: ["card_small", "card_medium", "card_large"],
            images: [],
            title: "",
            body: "",
            maxWidth: 0,
            maxHeight: 0,
        };
    },
    mounted() {
        if (!this.lightbox) {
            this.lightbox = new PhotoSwipeLightbox({
                gallery: "#gallery-list-photo",
                children: "#imageView",
                pswpModule: () => import("photoswipe"),
            });
            this.lightbox.init();
        }
        this.getPages();
    },
    methods: {
        getPages() {
            axios.post("/api/get-pages").then((response) => {
                this.pages = response.data.pages;
                // console.log(this.pages[0]);
                this.selectedIndex = 0;
                this.images.push(this.pages[0].image_1);
                this.images.push(this.pages[0].image_2);
                this.images.push(this.pages[0].image_3);
                this.images.push(this.pages[0].image_4);
                this.images.push(this.pages[0].image_5);
                this.images.push(this.pages[0].image_6);
                this.title = this.pages[0].title;
                this.body = this.pages[0].body_text;
            });
        },
        galleryClick(index) {
            // document.getElementById("gallery-list-photo").innerHTML = '';
            this.images = [];
            this.selectedIndex = index;
            this.images.push(this.pages[index].image_1);
            this.images.push(this.pages[index].image_2);
            this.images.push(this.pages[index].image_3);
            this.images.push(this.pages[index].image_4);
            this.images.push(this.pages[index].image_5);
            this.images.push(this.pages[index].image_6);
            this.title = this.pages[index].title;
            this.body = this.pages[index].body_text;
        },
        imageClicked(path, event) {
            if (event.target.tagName.toLowerCase() === "a") {
                const img = new Image();
                img.src = path;
                this.maxWidth = img.width;
                this.maxHeight = img.height;
            }
        },
        gallery_1() {
            if ((this.gallereActive_1 = true)) {
                this.gallereActive_2 = false;
                this.gallereActive_3 = false;
            }
            if ((this.active = "active")) {
                this.active2 = "";
                this.active3 = "";
            }
        },
        gallery_2() {
            if ((this.gallereActive_2 = true)) {
                this.gallereActive_1 = false;
                this.gallereActive_3 = false;
            }
            if ((this.active2 = "active")) {
                this.active = "";
                this.active3 = "";
            }
        },
        gallery_3() {
            if ((this.gallereActive_3 = true)) {
                this.gallereActive_1 = false;
                this.gallereActive_2 = false;
            }
            if ((this.active3 = "active")) {
                this.active2 = "";
                this.active1 = "";
            }
        },
    },
};
</script>

<style scoped lang="scss">
.gallery {
    .navigation-gallery {
        width: var(--width-main);
        height: 30px;
        border-bottom: 2px solid #c9c9c9;
        text-align: center;
        button {
            border: 0;
            outline: 0;
            background-color: none;
            background: none;
            cursor: pointer;
            border-bottom: 2px solid #c9c9c9;
            color: #888888;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 600;
            font-family: var(--font-family-btn-navigation);
            transition: var(--transition);
            padding: 0 20px 13px 20px;
            &.active {
                color: #000;
                border-bottom: 2px solid #000;
            }
            &:hover {
                color: #000;
            }
        }
    }
    .gallery-list-photo {
        display: grid;
        position: relative;
        margin-top: 20px;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 280px);
        gap: 1px;
        div {
            background-color: #d4d4d4;
            &.red {
                background-color: #dd3f3f;
            }
            &.green {
                background-color: #8bdd3f;
            }
            a {
                position: absolute;
                z-index: 2;
                width: 100%;
                height: auto;
                object-fit:cover;
                top: 0;
                left: 0;
                right:0;
                bottom:0;
                // width: 100%;
                // height: calc(100% + 50px);
                background-color: rgba(0, 0, 0, 0);
                background-image: url(@/front/assets/maximize.svg);
                background-repeat: no-repeat;
                background-position: top calc(50% - 25px) center;
                background-size: 0;
                transition: background 0.2s ease;
                &:hover {
                    background-color: rgba(255, 255, 255, 0.152);
                    background-image: url(@/front/assets/maximize.svg);
                    background-repeat: no-repeat;
                    background-position: top calc(50% - 25px) center;
                    background-size: 42px;
                }
                @media (max-width: 700px) {
                    background-color: rgba(0, 0, 0, 0) !important;
                }
            }
            #imageImg {
                width: 100%;
                height: 100%;
                object-fit:cover;
            }
        }
    }
    .gallery-text {
        position: relative;
        width: var(--width-main);
        background-color: #fafafa;
        height: 510px;
        padding: 70px 20px;
        box-sizing: border-box;
        margin-top: 1px;
        overflow: hidden;
        &.maxheight {
            height: auto !important;
        }
        h2 {
            display: block;
            padding: 0;
            margin: 0;
            text-align: center;
            width: var(--width-main);
            color: var(--color-purple-h2);
            font-size: var(--font-saze-h2);
            font-family: var(--font-family-neumann);
            font-weight: normal;
        }
        .conteaner-text {
            max-width: 678px;
            margin: 0 auto;
            box-sizing: border-box;
            p {
                width: 100%;
                color: #3b3b3b;
                font-size: var(--font-saze-p-gallery);
                line-height: 22px;
                font-family: var(--font-family-times);
                text-align: center;
                padding: 10px 0;
                margin: 0;
                text-align: justify;
            }
        }
        .conteaner-hidden-botton {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 300px;
            text-align: center;
            &.dnone {
                display: none;
            }
            &::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 270px;
                background: rgb(2, 0, 36);
                background: linear-gradient(
                    180deg,
                    rgba(250, 250, 250, 0) 0%,
                    rgba(250, 250, 250, 0.9) 30%,
                    rgba(250, 250, 250, 1) 50%,
                    rgba(250, 250, 250, 1) 100%
                );
            }
            button {
                border: 0;
                outline: none;
                height: 40px;
                box-sizing: border-box;
                background-color: #412b5f;
                color: var(--color-white);
                font-weight: var(--font-weight-btn-navigation);
                font-family: var(--font-family);
                font-size: 14px;
                padding: 0 20px;
                position: relative;
                z-index: 2;
                margin-top: 170px;
                cursor: pointer;
            }
        }
    }
}
</style>
