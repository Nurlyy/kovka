<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Персонал</h1>
        <div>
            <CFormLabel for="show">Показывать? </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeVisibility"
                :checked="visibility"
                id="show"
            />
        </div>
        <a
            href="/admin/personal/add-personal"
            class="btn btn-primary"
            style="margin-left: 30px; height: fit-content"
            ><CIcon icon="cil-plus" size="sm" /> Добавить человека</a
        >
    </div>
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Имя</th>
                <th>Должность</th>
                <th>Показывать</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>
                    <div class="table_td">{{ item.id }}</div>
                </td>
                <td>
                    <div class="table_td">{{ item.name }}</div>
                </td>
                <td>
                    <div class="table_td">{{ item.position }}</div>
                </td>
                <td>
                    <div class="table_td">
                        <CFormCheck
                            style="margin-left: 15px"
                            :checked="item.visibility"
                            id="show"
                            disabled
                        />
                    </div>
                </td>
                <td>
                    <CButton
                        component="a"
                        color="info"
                        :href="'/admin/personal/' + item.id"
                        role="button"
                        ><CIcon icon="cil-pen" size="sm" /> Изменить</CButton
                    >
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <div class="table_td">
                        <CButton
                            @click="deletePage(item.id)"
                            color="danger"
                            role="button"
                            ><CIcon icon="cil-trash" size="sm" />
                            Удалить</CButton
                        >
                    </div>
                </td>
            </tr>
        </tbody>
    </CTable>
</template>

<script>
import router from "@/admin/router/index.js";
export default {
    name: "Personal",
    data() {
        return {
            items: [],
            visibility: false,
        };
    },
    mounted() {
        axios.post("/api/get-personals-admin", {}).then((response) => {
            this.items = response.data.items;
        });
        axios.post("/api/get-personal-status").then((response) => {
            this.visibility = response.data.visibility == 1 ? true : false;
        });
    },
    methods: {
        deletePage(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios
                    .post("/api/delete-personal", { id: id })
                    .then((response) => {
                        window.location.reload();
                        // router.push({ name: "Pages" });
                    });
            }
        },
        changeVisibility() {
            axios
                .post("/api/set-personal-status")
                .then((response) => {
                    this.visibility = response.data.visibility == 1 ? true : false;
                });
        },
    },
};
</script>
<style scoped>
.table_td {
    display: flex;
    justify-content: center;
}
</style>
