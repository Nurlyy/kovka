<template>
    <CAlert :visible="alert_state" color="success">Изменения сохранены</CAlert>
    <h1>Изменить аккаунт админа</h1>
    <CForm @submit.prevent="submitForm">
        <div style="width: 50%">
            <div class="mb-3">
                <CFormLabel for="email">Email</CFormLabel>
                <CFormInput
                    v-model="email"
                    :value="email"
                    type="text"
                    id="email"
                    placeholder="name@example.com"
                />
            </div>
            <div class="mb-3">
                <CFormLabel for="username">Имя пользователя</CFormLabel>
                <CFormInput
                    v-model="username"
                    :value="username"
                    type="text"
                    id="username"
                    placeholder="admin"
                />
            </div>
            <div class="mb-3">
                <CFormLabel for="password">Новый пароль</CFormLabel>
                <CFormInput
                    v-model="password"
                    :value="password"
                    type="text"
                    id="password"
                    placeholder="Введите новый пароль"
                />
            </div>
            <button class="btn btn-primary">
                <CIcon icon="cil-save" size="sm" /> Сохранить
            </button>
        </div>
    </CForm>
</template>

<script>
export default {
    name: "User",
    data() {
        return {
            email: "",
            username: "",
            password: "",
            alert_state: false,
        };
    },
    mounted() {
        axios.post("/api/get-admin", {}).then((response) => {
            this.email = response.data.email;
            this.username = response.data.name;
            // console.log(response.data);
            // this.password = response.data.password;
        });
    },
    methods: {
        submitForm() {
            axios
                .post("/api/save-admin", {
                    email: this.email,
                    username: this.username,
                    password: this.password,
                })
                .then((response) => {
                    console.log(response.data);
                    this.alert_state = true;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    setTimeout(() => {
                        this.alert_state = false;
                    }, 3000);
                });
            //   alert('saved');
        },
    },
};
</script>

<style></style>
