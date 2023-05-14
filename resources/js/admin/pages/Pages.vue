<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Вкладки</h1>
        <a
            href="/admin/pages/create-page"
            class="btn btn-primary"
            style="margin-left: 30px; height: fit-content"
            ><CIcon icon="cil-plus" size="sm"/> Создать вкладку</a
        >
    </div>
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Показывать</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td><div class="table_td">{{ item.id }}</div></td>
                <td><div class="table_td">{{ item.title }}</div></td>
                <td><div class="table_td"><CFormCheck style="margin-left: 15px" :checked='item.is_visible' id="show" disabled /></div></td>
                <td>
                    <CButton component="a" color="info" :href="'/admin/pages/' + item.id" role="button"><CIcon icon="cil-pen" size="sm"/> Изменить</CButton>
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>
                
                <td><div class="table_td"><CButton @click="deletePage(item.id)" color="danger" role="button"><CIcon icon="cil-trash" size="sm"/> Удалить</CButton></div></td>
            </tr>
        </tbody>
    </CTable>
</template>

<script>
export default {
    name: "Filters",
    data() {
        return {
            items: [],
        };
    },
    mounted() {
        axios.post("/api/get-pages-admin", {}).then((response) => {
            this.items = response.data.pages;
        });
    },
    methods: {
        deletePage(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-page", { id: id }).then((response) => {
                window.location.reload();
                // router.push({ name: "Pages" });
            });
            }
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