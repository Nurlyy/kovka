<template>
    <div v-if="isLoading" class="loading-overlay">
        <CButton disabled>
            <CSpinner
                component="span"
                size="xsl"
                color="light"
                aria-hidden="true"
            />
        </CButton>
    </div>
    <h1 v-if="id == null">Добавить Страницу</h1>
    <h1 v-if="id != null">Изменить Страницу</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="name"
                >Придумайте URL (латинскими буквами)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="name"
                :value="name"
                @change="slugify_name()"
                id="name"
                placeholder="NAME"
            />
        </div>
        <div class="mb-3">
            <CFormLabel for="slug">URL</CFormLabel>
            <CFormInput
                id="slug"
                type="text"
                placeholder="SLUG"
                aria-label="Disabled input example"
                v-model="slug"
                :value="slug"
                disabled
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="header_title">SEO - title</CFormLabel>
            <CFormInput
                type="text"
                v-model="header_title"
                :value="header_title"
                id="header_title"
                placeholder="Заголовок"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="title"
                >Заголовок страницы (Отображается на странице)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="title"
                :value="title"
                id="title"
                placeholder="TITLE"
            />
        </div>

        <CFormLabel for="title">Текст страницы</CFormLabel>
        <!-- <QuillEditor
            v-model:value="body"
            v-model:content="body"
            contentType="html"
            theme="snow"
        /> -->
        <mavon-editor
            v-model="body"
            :language="'ru'"
            :html="true"
            @htmlCode="htmlCode"
            :htmlValue="htmlValueFromEditor"
            @save="change"
            @imgAdd="imgUpload"
            ref="mavoneditor"
        />

        <!-- <editor-content :editor="editor" /> -->

        <!-- <div class="mb-3">
            <CFormLabel for="body">Body</CFormLabedl>
            <CFormTextarea id="body" v-model="body" rows="3">{{
                this.body
            }}</CFormTextarea>
        </div> -->

        <div class="mb-3">
            <CFormLabel for="keyword"
                >SEO - Ключевые слова (Укажите через запятую)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="keyword"
                :value="keyword"
                id="keyword"
                placeholder="Keyword"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="description"
                >SEO - Description (Описание)</CFormLabel
            >
            <CFormTextarea
                id="description"
                v-model="description"
                :value="description"
                rows="3"
            ></CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="show"
                >Показывать ссылку на страницу в меню?
            </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeVisibility"
                :checked="visibility"
                id="show"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="show">Добавить в страницу статей </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeBlog"
                :checked="isPreview"
                id="show"
            />
        </div>

        <CCollapse :visible='isPreview' class="mb-3">
            <CCard>
                
                <CCardBody>
                    <CCardTitle class="mb-3">Настройки превью</CCardTitle>
                    <div>
                        <img
                            id="imagePreview"
                            alt="Preview Image"
                            style="
                                height: 150px;
                                border-radius: 15px;
                                margin-top: 15;
                                display: none;
                            "
                            class="mb-3"
                        />
                    </div>

                    <CFormLabel v-if="id == null" for="image"
                        >Изображение</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image"
                        >Изменить изображение</CFormLabel
                    >
                    <CFormInput
                        @change="saveImage($event)"
                        type="file"
                        id="image"
                        class="mb-3"
                    />

                    <div class="mb-3">
                        <CFormLabel for="preview_title"
                            >Заголовок превью</CFormLabel
                        >
                        <CFormInput
                            type="text"
                            v-model="preview_title"
                            :value="preview_title"
                            id="preview_title"
                        />
                    </div>

                    <div class="mb-3">
                        <CFormLabel for="body">Описание превью</CFormLabel>
                        <CFormTextarea
                            v-model="preview_body"
                            :value="preview_body"
                            type="text"
                            id="body"
                        />
                    </div>
                </CCardBody>
            </CCard>
        </CCollapse>

        <button class="btn btn-primary mb-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
// import { QuillEditor } from "@vueup/vue-quill";
// import "@vueup/vue-quill/dist/vue-quill.snow.css";
// import { Editor, EditorContent } from "@tiptap/vue-3";
// import StarterKit from "@tiptap/starter-kit";
import router from "@/admin/router/index.js";
import { throwStatement } from "@babel/types";
export default {
    name: "AddPage",
    components: {
        // QuillEditor,
        // EditorContent,
    },
    data() {
        return {
            name: "",
            slug: "",
            title: "",
            header_title: "",
            body: "",
            keyword: "",
            description: "",
            visibility: false,
            id: null,
            htmlValueFromEditor: "",
            editor: null,
            isLoading: false,
            isPreview: false,
            preview_title: "",
            preview_body: "",
            preview_image: null,
        };
    },
    methods: {
        changeBlog() {
            this.isPreview = !this.isPreview;
        },
        change(v, html) {
            console.log(v);
            console.log(html);
            this.body = html;
        },
        htmlCode(status, value) {
            this.htmlValueFromEditor = value;
        },
        changeVisibility() {
            this.visibility = !this.visibility;
        },
        slugify_name() {
            this.slug = this.slugify(this.name);
        },
        submitForm() {
            this.$refs.mavoneditor.save();
            // console.log(
            //     "HTML VALUE FROM EDITOR: \n" + this.body
            // );
            const visibility = this.visibility == true ? "1" : "0";
            this.isLoading = true;
            var formData = new FormData();
            formData.append("name", this.name);
            formData.append("slug", this.slug);
            formData.append("title", this.title);
            formData.append("header_title", this.header_title);
            formData.append("body", this.body);
            formData.append("keyword", this.keyword);
            formData.append("description", this.description);
            formData.append("visibility", visibility);
            formData.append("isPreview", this.isPreview);
            formData.append("preview_title", this.preview_title);
            formData.append("preview_body", this.preview_body);
            formData.append("preview_image", this.preview_image);
            if (this.id != null) {
                formData.append("id", this.id);
                axios.post("/api/update-page", formData).then((response) => {
                    this.isLoading = false;
                    console.log(response.data);
                    router.push({ name: "Pages" });
                });
            } else {
                axios.post("/api/add-page", formData).then((response) => {
                    this.isLoading = false;
                    console.log(response.data);
                    router.push({ name: "Pages" });
                });
                // alert("saved");
            }
        },
        slugify(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/[\s_-]+/g, "-")
                .replace(/^-+|-+$/g, "");
        },
        saveImage(event, number) {
            var preview;
            var image_id = "";
            this.preview_image = event.target.files[0];
            preview = document.getElementById("imagePreview");
            image_id = "imagePreview";

            // Create a new FileReader instance
            var reader = new FileReader();

            // Set the image preview source
            reader.onload = function (event) {
                preview.src = event.target.result;
            };

            preview.style.display = "block";

            // Read the image file as a data URL
            reader.readAsDataURL(event.target.files[0]);
        },
        // imgUpload(pos, file, $vm) {
        //     const formdata = new FormData();
        //     formdata.append("text", "text");
        //     formdata.append("image", file);
        //     console.log(pos, file, formdata);

        //     // ajax 上传
        //     // const _this = this;
        //     axios
        //         .post("/api/upload-image", { formdata })
        //         .then((res) => {
        //             // const { data } = res;
        //             // // data 就是img 的 url 地址
        //             // $vm.$img2Url(pos, data);
        //             console.log(res);
        //         })
        //         .catch((err) => {
        //             console.log(err);
        //         });

        //     // $vm.$img2Url(
        //     //     pos,
        //     //     "http://uploads.liqingsong.cc/20210430/f62d2436-8d92-407d-977f-35f1e4b891fc.png"
        //     // );
        // },
        imgUpload(pos, $file, $vm) {
            var formdata = new FormData();
            formdata.append("image", $file);
            // console.log(pos);
            // ajax上传
            axios({
                url: "/api/upload-image",
                method: "post",
                data: formdata,
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then((res) => {
                    console.log(res);
                    const { data } = res;
                    this.$refs.mavoneditor.$img2Url(pos, data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    created() {
        const slug = this.$route.params.slug;
        if (slug) {
            axios
                .post("/api/get-page-admin", { slug: slug })
                .then((response) => {
                    // this.page = response.data.page;
                    // console.log(reponse.data);
                    this.update = true;
                    this.name = response.data.page.name;
                    this.slug = response.data.page.slug;
                    this.title = response.data.page.title;
                    this.header_title = response.data.page.header_title;
                    this.body = response.data.page.body;
                    this.keyword = response.data.page.keyword;
                    this.description = response.data.page.description;
                    this.visibility =
                        response.data.page.show == "1" ? true : false;
                    this.id = response.data.page.id;
                    this.isPreview =
                        response.data.page.isPreview == "1" ? true : false;
                    this.preview_title = response.data.page.preview_title;
                    this.preview_body = response.data.page.preview_body;
                    this.preview_image = response.data.page.preview_image;
                });
        }

        // Fetch page data from database using slug
        // Set page data to this.page
    },
    beforeUnmount() {
        this.editor.destroy();
    },
};
</script>

<style scoped>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
</style>
