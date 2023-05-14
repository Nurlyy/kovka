<template>
    <h1 v-if="id == null">Добавить Преимущество</h1>
    <h1 v-if="id != null">Изменить Преимущество</h1>
    <br />
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <h5>Выбранное изображение преимущества</h5>
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
            <CFormLabel v-if="id == null" for="image"
                >Изображение преимущества</CFormLabel
            >
            <CFormLabel v-if="id != null" for="image"
                >Изменить изображение преимущества</CFormLabel
            >
            <CFormInput @change="saveImage" type="file" id="image" />
        </div>
        <br />
        <div class="mb-3">
            <CFormLabel for="title">Заголовок</CFormLabel>
            <CFormInput v-model="title" :value="title" id="title"></CFormInput>
        </div>
        <br />
        <div class="mb-3">
            <CFormLabel for="body">Тело</CFormLabel>
            <CFormTextarea
                v-model="body"
                :value="body"
                id="body"
                rows="3"
            ></CFormTextarea>
        </div>
        <br />
        <div class="mb-3">
            <CFormSelect v-model="page_id" aria-label="Default select example">
                <option>Выбрать статическую страницу</option>
                <option v-for="page, index in pages" :key='index' :selected='page_id == page.id' :value='page.id'>{{ page.name }}</option>
            </CFormSelect>
        </div>
        <br />
        <button :disabled="image == null" class="btn btn-primary mb-5 mt-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
import { ref } from "vue";
import router from "@/admin/router/index.js";
export default {
    name: "AddImage",
    data() {
        return {
            image: null,
            title: null,
            body: null,
            id: null,
            pages: [],
            page_id: null,
        };
    },
    mounted() {
        axios.post("/api/get-pages").then((response) => {
            if (response.data.items) {
                response.data.items.forEach((element) => {
                    this.pages.push(element);
                });
            }
        });
    },
    methods: {
        submitForm() {
            if (this.id == null) {
                if (this.image != null) {
                    let formData = new FormData();
                    formData.append("image", this.image);
                    formData.append("body", this.body);
                    formData.append("title", this.title);
                    formData.append('page_id', this.page_id);
                    axios
                        .post("/api/create-regalia", formData)
                        .then((response) => {
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            } else {
                if (this.image != null) {
                    let formData = new FormData();
                    formData.append("image", this.image);
                    formData.append("body", this.body);
                    formData.append("title", this.title);
                    formData.append("page_id", this.page_id);
                    formData.append("id", this.id);
                    axios
                        .post("/api/update-regalia", formData)
                        .then((response) => {
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }
            setTimeout(() => {
                router.push({ name: "Regalias" });
            }, 500);
        },
        saveImage(event) {
            this.image = event.target.files[0];
            var preview = document.getElementById("imagePreview");

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
        // axios.post("/api/get-filters", {}).then((response) => {
        //     this.availableFilters = response.data.filters;
        // });
        const id = this.$route.params.id;
        if (id) {
            axios.post("/api/get-regalia", { id: id }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.image = response.data.regalia.image;
                this.body = response.data.regalia.body;
                this.title = response.data.regalia.title;
                this.page_id = response.data.regalia.page_id;
                // this.imageFilters =
                //     response.data.image_filters.length >= 1
                //         ? response.data.image_filters
                //         : [];
                this.id = id;
                var preview = document.getElementById("imagePreview");
                preview.src = this.image;
                preview.style.display = "block";

                // if (this.availableFilters.includes(imageFilter)) {
                //     this.availableFilters.splice(
                //         this.availableFilters.indexOf(imageFilter),
                //         1
                //     );
                // }
            });
        }
    },
};
</script>

<style></style>
