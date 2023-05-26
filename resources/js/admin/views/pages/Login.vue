<template>
    <CAlert
        color="primary"
        :visible="alertVisible"
        dismissible
        @close="
            () => {
                alertVisible = false;
            }
        "
        >Вы ввели неверные данные!</CAlert
    >
    <div class="bg-light">
        <div class="min-vh-100 d-flex flex-row align-items-center">
            <CContainer>
                <CRow class="justify-content-center">
                    <CCol :md="8">
                        <CCardGroup>
                            <CCard class="p-4">
                                <CCardBody>
                                    <CForm @submit.prevent="login">
                                        <h1>Login</h1>
                                        <p class="text-medium-emphasis">
                                            Sign In to your account
                                        </p>
                                        <CInputGroup class="mb-3">
                                            <CInputGroupText>
                                                <CIcon icon="cil-user" />
                                            </CInputGroupText>
                                            <CFormInput
                                                placeholder="Username"
                                                autocomplete="username"
                                                v-model="email"
                                            />
                                        </CInputGroup>
                                        <CInputGroup class="mb-4">
                                            <CInputGroupText>
                                                <CIcon icon="cil-lock-locked" />
                                            </CInputGroupText>
                                            <CFormInput
                                                type="password"
                                                placeholder="Password"
                                                autocomplete="current-password"
                                                v-model="password"
                                            />
                                        </CInputGroup>
                                        <CRow>
                                            <CCol :xs="6">
                                                <CButton
                                                    color="primary"
                                                    @click="login()"
                                                    class="px-4"
                                                >
                                                    Login
                                                </CButton>
                                            </CCol>
                                        </CRow>
                                    </CForm>
                                </CCardBody>
                            </CCard>
                        </CCardGroup>
                    </CCol>
                </CRow>
            </CContainer>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "@/admin/router/index.js";
export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            alertVisible: false,
        };
    },
    mounted(){
        const token = localStorage.getItem(
                            "access_token"
                        );
        axios.post('/api/me').then((response) => {
            if(response.data.status == 'true') {
                router.push({ name: "Tabs" });
            }
        })
    },
    methods: {
        login() {
            console.log("clicked");
            // axios
            //     .post("/api/login", {
            //         email: this.email,
            //         password: this.password,
            //     })
            //     .then((response) => {
            //         console.log(response);
            //         if (response.data.status == 401) {
            //             this.alertVisible = true;
            //             setTimeout(() => {
            //                 this.alertVisible = false;
            //             }, 2500);
            //         }
            //         // Save access token to local storage
            //         localStorage.setItem(
            //             "access_token",
            //             response.data.access_token
            //         );
            //         // Redirect to admin index page
            //         router.push({ name: "Images" });
            //     })
            //     .catch((error) => {
            //         if (error) {
            //             console.log(error.message);
            //             console.log("error");
            //             this.alertVisible = true;
            //             setTimeout(() => {
            //                 this.alertVisible = false;
            //             }, 2500);
            //         }
            //     });

            axios
                .post("/api/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    if (response.data.status == 401) {
                        throw new Error('unauthorized');
                    } else {
                        // Save access token to local storage
                        localStorage.setItem(
                            "access_token",
                            response.data.access_token
                        );
                        // Redirect to admin index page
                        router.push({ name: "Tabs" });
                    }
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error.message);
                    if (error) {
                        console.log(error);
                    }
                    this.alertVisible = true;
                    setTimeout(() => {
                        this.alertVisible = false;
                    }, 2500);
                });
        },
    },
};
</script>
