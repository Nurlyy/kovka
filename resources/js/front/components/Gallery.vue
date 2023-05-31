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
            <div
                style="position: relative"
                v-for="(image, index) in images"
                :key="index"
            >
                <img
                    :src="image.preview"
                    :alt="image.description"
                    class="imageImg"
                    :id="'imageImg_' + index"
                />
                <a
                    @click="imageClicked(image.image, $event)"
                    :href="image.image"
                    :data-pswp-width="maxWidth"
                    :data-pswp-height="maxHeight"
                    target="_blank"
                    rel="noreferrer"
                    id="imageView"
                    :aria-label='image.description'
                >
                </a>
            </div>
        </div>
        <div class="gallery-text" :class="maxheightClass">
            <h2>{{ title }}</h2>
            <div class="conteaner-text">
                <p v-html="body"></p>
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

<!-- IMPORTANT!!! 
    IF FULLSCREEN VIEW IS NOT WORKING{
        CHANGE MAIN CSS PROPERTY IN TWO FILES OF PHOTOSWIPE ROOT DIRECTORY {
            .pswp img {
                max-width: none;
                object-fit:contain !important;
            }
        }
    }
-->

<script>
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";
// import applyFilter from "../assets/pixels/script";
// import pixelsJs from "../assets/pixels/pixels";
// import pixelsJS from "pixelsJS";
export default {
    name: "Gallery",

    data() {
        return {
            pages: null,
            ids: null,
            selectedIndex: -1,
            images: [],
            title: "",
            body: "",
            maxWidth: 0,
            maxHeight: 0,
            maxheightClass: "",
            dnoneActive: "",
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
        imageClicked(path, event) {
            if (event.target.tagName.toLowerCase() === "a") {
                const img = new Image();
                img.src = path;
                // img.onload = () => {
                this.maxWidth = img.width;
                this.maxHeight = img.height;
                // };

                console.log("maxWidth: " + this.maxWidth);
                console.log("maxHeight: " + this.maxHeight);
            }
        },
        getPages() {
            axios.post("/api/get-tabs").then((response) => {
                this.pages = response.data.tabs;
                // console.log(this.pages[0]);
                this.selectedIndex = 0;
                if (this.pages[0]) {
                    this.images.push({
                        image: this.pages[0].image_1,
                        preview: this.pages[0].image_1_preview,
                        description: this.pages[0].description1,
                    });
                    this.images.push({
                        image: this.pages[0].image_2,
                        preview: this.pages[0].image_2_preview,
                        description: this.pages[0].description2,
                    });
                    this.images.push({
                        image: this.pages[0].image_3,
                        preview: this.pages[0].image_3_preview,
                        description: this.pages[0].description3,
                    });
                    this.images.push({
                        image: this.pages[0].image_4,
                        preview: this.pages[0].image_4_preview,
                        description: this.pages[0].description4,
                    });
                    this.images.push({
                        image: this.pages[0].image_5,
                        preview: this.pages[0].image_5_preview,
                        description: this.pages[0].description5,
                    });
                    this.images.push({
                        image: this.pages[0].image_6,
                        preview: this.pages[0].image_6_preview,
                        description: this.pages[0].description6,
                    });

                    this.title = this.pages[0].title;
                    this.body = this.pages[0].body_text;
                }
            });
        },
        galleryClick(index) {
            this.images = [];
            this.selectedIndex = index;
            this.images.push({
                image: this.pages[index].image_1,
                preview: this.pages[index].image_1_preview,
                description: this.pages[index].description1,
            });
            this.images.push({
                image: this.pages[index].image_2,
                preview: this.pages[index].image_2_preview,
                description: this.pages[index].description2,
            });
            this.images.push({
                image: this.pages[index].image_3,
                preview: this.pages[index].image_3_preview,
                description: this.pages[index].description3,
            });
            this.images.push({
                image: this.pages[index].image_4,
                preview: this.pages[index].image_4_preview,
                description: this.pages[index].description4,
            });
            this.images.push({
                image: this.pages[index].image_5,
                preview: this.pages[index].image_5_preview,
                description: this.pages[index].description5,
            });
            this.images.push({
                image: this.pages[index].image_6,
                preview: this.pages[index].image_6_preview,
                description: this.pages[index].description6,
            });

            this.title = this.pages[index].title;
            this.body = this.pages[index].body_text;
            this.maxheightClass = "";
            this.dnoneActive = "";
        },
    },
};
</script>

<style scoped lang="scss">
.gallery {
    .navigation-gallery {
        width: var(--width-main);
        height: auto;
        border-bottom: 2px solid #c9c9c9;
        text-align: center;
        button {
            display: inline-block;
            border: 0;
            outline: 0;
            background-color: none;
            position: relative;
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
            margin-bottom: -2px;
            &::after {
                transition: var(--transition);
                content: "";
                position: absolute;
                z-index: 2;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                width: 0px;
                height: 0px;
                border-radius: 50%;
                top: 0;
                background-color: #000;
            }
            @media (max-width: 830px) {
                font-size: 12px;
                padding: 0 18px 10px 18px;
            }
            @media (max-width: 700px) {
                font-size: 11px;
                padding: 0 14px 8px 14px;
            }
            @media (max-width: 640px) {
                font-size: 12px;
                padding: 0 14px 10px 14px;
                border-bottom: 0px !important;
            }
            &.active {
                color: #000;
                border-bottom: 2px solid #000;
                @media (max-width: 640px) {
                    color: #000;
                    font-size: 12px;
                    padding: 0 14px 10px 14px;
                    border-bottom: 0px !important;
                }
            }
            &:hover {
                color: #000;
                &::after {
                    transition: var(--transition);
                    content: "";
                    position: absolute;
                    z-index: 2;
                    margin-left: auto;
                    margin-right: auto;
                    left: 0;
                    right: 0;
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    top: -15px;
                    background-color: #000;
                }
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
        @media (max-width: 830px) {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 280px);
        }
        @media (max-width: 420px) {
            grid-template-columns: repeat(1, 1fr);
            grid-template-rows: repeat(6, 220px);
        }
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
                object-fit: cover;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
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
            .imageImg {
                width: 100%;
                height: 100%;
                object-fit: cover;
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
            max-width: 700px;
            padding: 0;
            margin: 0 auto;
            text-align: center;
            width: var(--width-main);
            color: var(--color-purple-h2);
            font-size: var(--font-saze-h2);
            font-family: var(--font-family-neumann);
            font-weight: normal;
            @media (max-width: 830px) {
                font-size: 27px;
            }
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
