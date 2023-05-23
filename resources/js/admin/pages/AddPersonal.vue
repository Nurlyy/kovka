<template>
    <div v-if="isLoading" class="loading-overlay">
        <CButton disabled>
            <CSpinner component="span" size="xsl" color='light' aria-hidden="true"/>
        </CButton>
    </div>
    <h1 v-if="id == null">Добавить Человека</h1>
    <h1 v-if="id != null">Изменить Человека</h1>
    <CForm @submit.prevent="submitForm()">
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

        <CFormLabel v-if="id == null" for="image">Изображение</CFormLabel>
        <CFormLabel v-if="id != null" for="image"
            >Изменить изображение</CFormLabel
        >
        <CFormInput
            @change="
                saveImage($event);
            "
            type="file"
            id="image"
            class="mb-3"
        />

        <div class="mb-3">
            <CFormLabel for="name">Имя</CFormLabel>
            <CFormInput
                type="text"
                v-model="name"
                :value="name"
                id="name"
                placeholder="Имя"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="position">Должность</CFormLabel>
            <CFormInput
                type="text"
                v-model="position"
                :value="position"
                id="position"
                placeholder="Должность"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="email">Email</CFormLabel>
            <CFormInput
                type="text"
                v-model="email"
                :value="email"
                id="email"
                placeholder="email"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="body">Описание</CFormLabel>
            <CFormTextarea v-model="body" :value='body'  type="text" id="body" />
        </div>

        <div class="mb-3">
            <CFormLabel for="show"
                >Показывать человека на сайте?
            </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeVisibility"
                :checked="visibility"
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
    components: {
        // QuillEditor,
        // EditorContent,
    },
    data() {
        return {
            position: "",
            name: "",
            body: "",
            visibility: false,
            id: null,
            image:null,
            email:null,
            isLoading: false,
        };
    },
    methods: {
        saveImage(event, number) {
            var preview;
            var image_id = "";
            this.image = event.target.files[0];
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
        changeVisibility() {
            this.visibility = !this.visibility;
        },
        submitForm() {
            // console.log(
            //     "HTML VALUE FROM EDITOR: \n" + this.body
            // );
            this.isLoading = true;
            const visibility = this.visibility == true ? "1" : "0";
            let formData = new FormData();
            formData.append("position", this.position);
            formData.append("name", this.name);
            formData.append("body", this.body);
            formData.append("visibility", visibility);
            formData.append("image", this.image);
            formData.append("email", this.email);
            if (this.id != null) {
                formData.append("id", this.id);
                axios
                    .post("/api/update-personal", 
                        formData
                    )
                    .then((response) => {
                        console.log(response.data);
                        this.isLoading = false;
                        router.push({ name: "Personal" });
                    });
            } else {
                axios
                    .post("/api/add-personal", 
                        formData
                    )
                    .then((response) => {
                        console.log(response.data);
                        this.isLoading = false;
                        router.push({ name: "Personal" });
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
    },
    created() {
        const id = this.$route.params.id;
        if (id) {
            axios
                .post("/api/get-personal-admin", { id: id })
                .then((response) => {
                    // this.page = response.data.page;
                    // console.log(reponse.data);
                    this.position = response.data.personal.position;
                    this.name = response.data.personal.name;
                    this.body = response.data.personal.body;
                    this.image = response.data.personal.image;
                    this.email = response.data.personal.email;
                    this.visibility =
                        response.data.personal.visibility == "1" ? true : false;
                    this.id = id;
                    var preview;
                    if (this.image != null) {
                        preview = document.getElementById("imagePreview");
                        preview.src = this.image;
                        preview.style.display = "block";
                    }
                });
        }

        // Fetch personal data from database using id
        // Set personal data 
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
