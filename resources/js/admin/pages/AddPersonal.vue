<template>
    <h1 v-if="id == null">Добавить Работника</h1>
    <h1 v-if="id != null">Изменить Работника</h1>
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
            >Изменить изображение №1</CFormLabel
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
                @change="slugify_name()"
                id="name"
                placeholder="NAME"
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
            const visibility = this.visibility == true ? "1" : "0";
            if (this.id != null) {
                axios
                    .post("/api/update-personal", {
                        position : this.position,
                        name : this.name,
                        body : this.body,
                        visibility : this.visibility,
                        id : this.id,
                        image : this.image,
                        email : this.email,
                    })
                    .then(function (response) {
                        console.log(response.data);
                    });
            } else {
                axios
                    .post("/api/add-personal", {
                        name: this.name,
                        slug: this.slug,
                        title: this.title,
                        header_title: this.header_title,
                        body: this.body,
                        keyword: this.keyword,
                        description: this.description,
                        visibility: this.visibility,
                    })
                    .then(function (response) {
                        console.log(response.data);
                    });
                // alert("saved");
            }
            setTimeout(() => {
                router.push({ name: "Pages" });
            }, 500);
        },
        slugify(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/[\s_-]+/g, "-")
                .replace(/^-+|-+$/g, "");
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

<style></style>
