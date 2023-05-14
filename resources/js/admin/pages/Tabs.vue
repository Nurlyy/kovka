<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Вкладки</h1>
        <a
            href="/admin/tabs/create-tab"
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
                    <CButton component="a" color="info" :href="'/admin/tabs/' + item.id" role="button"><CIcon icon="cil-pen" size="sm"/> Изменить</CButton>
                 </td>
                
                <td><div class="table_td"><CButton @click="deleteTab(item.id)" color="danger" role="button"><CIcon icon="cil-trash" size="sm"/> Удалить</CButton></div></td>
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
        axios.post("/api/get-tabs-admin", {}).then((response) => {
            this.items = response.data.tabs;
        });
    },
    methods: {
        deleteTab(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-tab", { id: id }).then((response) => {
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