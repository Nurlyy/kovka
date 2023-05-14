<template>
    <h1 v-if="id == null">Добавить Вкладку</h1>
    <h1 v-if="id != null">Изменить Вкладку</h1>
    <CForm @submit.prevent="submitForm()">
        <!-- <div class="mb-3">
        <CFormLabel for="name">Придумайте URL (латинскими буквами)</CFormLabel>
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
    </div> -->

        <!-- <div class="mb-3">
        <CFormLabel for="header_title">SEO - title</CFormLabel>
        <CFormInput
            type="text"
            v-model="header_title"
            :value="header_title"
            id="header_title"
            placeholder="Заголовок"
        />
    </div> -->
        <div class="mb-3">
            <CFormLabel for="title"
                >Заголовок вкладки (Отображается вверху)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="header"
                :value="header"
                id="header"
                placeholder="HEADER"
            />
        </div>
        <div class="mb-3">
            <CFormLabel for="title"
                >Заголовок вкладки (Отображается на странице)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="title"
                :value="title"
                id="title"
                placeholder="TITLE"
            />
        </div>

        <CFormLabel for="title">Текст вкладки</CFormLabel>
        <CFormTextarea
            v-model="body"
            :value="body"
            id="body"
            rows="3"
            class="mb-3"
        ></CFormTextarea>

        <div class="mb-3">
            <h5 v-if="image1 != null">Выбранное изображение №1 для вкладки</h5>
            <img
                id="imagePreview1"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image1"
                >Изображение №1</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image1"
                >Изменить изображение №1</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 1)"
                type="file"
                id="image1"
            />
        </div>

        <div class="mb-3">
            <h5 v-if="image2 != null">Выбранное изображение №2 для вкладки</h5>
            <img
                id="imagePreview2"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image2"
                >Изображение №2</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image2"
                >Изменить изображение №2</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 2)"
                type="file"
                id="image2"
            />
        </div>

        <div class="mb-3">
            <h5 v-if="image3 != null">Выбранное изображение №3 для вкладки</h5>
            <img
                id="imagePreview3"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image3"
                >Изображение №3</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image3"
                >Изменить изображение №3</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 3)"
                type="file"
                id="image3"
            />
        </div>

        <div class="mb-3">
            <h5 v-if="image4 != null">Выбранное изображение №4 для вкладки</h5>
            <img
                id="imagePreview4"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image4"
                >Изображение №4</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image4"
                >Изменить изображение №4</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 4)"
                type="file"
                id="image4"
            />
        </div>

        <div class="mb-3">
            <h5 v-if="image5 != null">Выбранное изображение №5 для вкладки</h5>
            <img
                id="imagePreview5"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image5"
                >Изображение №5</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image5"
                >Изменить изображение №5</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 5)"
                type="file"
                id="image5"
            />
        </div>

        <div class="mb-3">
            <h5 v-if="image6 != null">Выбранное изображение №6 для вкладки</h5>
            <img
                id="imagePreview6"
                alt="Preview Image"
                style="
                    height: 150px;
                    border-radius: 15px;
                    margin-top: 15;
                    display: none;
                "
                class="mb-3"
            />
            <CFormLabel v-if="id == null" for="image6"
                >Изображение №6</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image6"
                >Изменить изображение №6</CFormLabel
            >
            <CFormInput
                @change="saveImage($event, 6)"
                type="file"
                id="image6"
            />
        </div>

        <!-- <div class="mb-3">
            <CFormLabel for="body">Body</CFormLabedl>
            <CFormTextarea id="body" v-model="body" rows="3">{{
                this.body
            }}</CFormTextarea>
        </div> -->

        <!-- <div class="mb-3">
        <CFormLabel for="keyword">SEO - Ключевые слова (Укажите через запятую)</CFormLabel>
        <CFormInput
            type="text"
            v-model="keyword"
            :value="keyword"
            id="keyword"
            placeholder="Keyword"
        />
    </div> -->

        <!-- <div class="mb-3">
        <CFormLabel for="description">SEO - Description (Описание)</CFormLabel>
        <CFormTextarea
            id="description"
            v-model="description"
            :value="description"
            rows="3"
        ></CFormTextarea>
    </div> -->

        <div class="mb-3">
            <CFormLabel for="show">Показывать вкладку? </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeVisibility"
                :checked="is_visible"
                id="show"
            />
        </div>

        <button class="btn btn-primary mb-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
import router from "@/admin/router/index.js";
export default {
    name: "AddPage",
    data() {
        return {
            title: "",
            body: "",
            is_visible: false,
            id: null,
            image1: null,
            image2: null,
            image3: null,
            image4: null,
            image5: null,
            image6: null,
            header: null,
        };
    },
    methods: {
        changeVisibility() {
            this.is_visible = !this.is_visible;
        },
        submitForm() {
            // console.log(this.body);
            const is_visible = this.is_visible == true ? "1" : "0";
            let formData = new FormData();
            formData.append("body_text", this.body);
            formData.append("title", this.title);
            formData.append("is_visible", is_visible);
            formData.append("image1", this.image1);
            formData.append("image2", this.image2);
            formData.append("image3", this.image3);
            formData.append("image4", this.image4);
            formData.append("image5", this.image5);
            formData.append("image6", this.image6);
            formData.append("header", this.header);
            if (this.id != null) {
                formData.append("id", this.id);
                axios
                    .post("/api/update-tab", formData)
                    .then(function (response) {
                        console.log(response.data);
                    });
            } else {
                axios
                    .post("/api/create-tab", formData)
                    .then(function (response) {
                        console.log(response.data);
                    });
                // alert("saved");
            }
            setTimeout(() => {
                router.push({ name: "Tabs" });
            }, 500);
        },
        saveImage(event, number) {
            var preview;
            switch (number) {
                case 1:
                    this.image1 = event.target.files[0];
                    preview = document.getElementById("imagePreview1");
                    break;
                case 2:
                    this.image2 = event.target.files[0];
                    preview = document.getElementById("imagePreview2");
                    break;
                case 3:
                    this.image3 = event.target.files[0];
                    preview = document.getElementById("imagePreview3");
                    break;
                case 4:
                    this.image4 = event.target.files[0];
                    preview = document.getElementById("imagePreview4");
                    break;
                case 5:
                    this.image5 = event.target.files[0];
                    preview = document.getElementById("imagePreview5");
                    break;
                case 6:
                    this.image6 = event.target.files[0];
                    preview = document.getElementById("imagePreview6");
                    break;
            }

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
    },
    created() {
        const id = this.$route.params.id;
        if (id) {
            axios.post("/api/get-tabs-admin", { id: id }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.title = response.data.tabs.title;
                this.body = response.data.tabs.body_text;
                this.is_visible =
                    response.data.tabs.is_visible == "1" ? true : false;
                this.id = response.data.tabs.id;
                this.image1 = response.data.tabs.image_1;
                this.image2 = response.data.tabs.image_2;
                this.image3 = response.data.tabs.image_3;
                this.image4 = response.data.tabs.image_4;
                this.image5 = response.data.tabs.image_5;
                this.image6 = response.data.tabs.image_6;
                this.header = response.data.tabs.header;
                var preview;
                if (this.image1 != null) {
                    preview = document.getElementById("imagePreview1");
                    preview.src = this.image1;
                    preview.style.display = "block";
                }

                if (this.image2 != null) {
                    preview = document.getElementById("imagePreview2");
                    preview.src = this.image2;
                    preview.style.display = "block";
                }

                if (this.image3 != null) {
                    preview = document.getElementById("imagePreview3");
                    preview.src = this.image3;
                    preview.style.display = "block";
                }

                if (this.image4 != null) {
                    preview = document.getElementById("imagePreview4");
                    preview.src = this.image4;
                    preview.style.display = "block";
                }

                if (this.image5 != null) {
                    preview = document.getElementById("imagePreview5");
                    preview.src = this.image5;
                    preview.style.display = "block";
                }

                if (this.image6 != null) {
                    preview = document.getElementById("imagePreview6");
                    preview.src = this.image6;
                    preview.style.display = "block";
                }
            });
        }

        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style></style>
