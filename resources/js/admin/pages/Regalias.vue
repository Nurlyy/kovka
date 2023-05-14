<template>
    <div class="d-flex flex-row justify-content-between">
        <h1>Преимущества</h1>
        <a
            href="/admin/regalias/create-regalia"
            class="btn btn-primary"
            style="margin-left: 30px; height: fit-content"
            ><CIcon icon="cil-plus" size="sm" /> Добавить преимущество</a
        >
    </div>
    <br />
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Фото</th>
                <th>Заголовок</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="regalia in regalias" :key="regalia.id">
                <td>
                    <div class="table_td">{{ regalia.id }}</div>
                </td>
                <td>
                    <div class="table_td">
                        <img :src="regalia.image" height="80" />
                    </div>
                </td>
                <td>
                    <div class="table_td">{{ regalia.title }}</div>
                </td>
                <td>
                    <div class="table_td">
                        <CButton
                            component="a"
                            color="info"
                            :href="'/admin/regalia/' + regalia.id"
                            role="button"
                            ><CIcon icon="cil-pen" size="sm" />
                            Изменить</CButton
                        >
                    </div>
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <div class="table_td">
                        <CButton
                            @click="deleteRegalia(regalia.id)"
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
    <!-- <CPagination aria-label="Page navigation example">
        <CPaginationItem
            @click="decreasePage"
            aria-label="Previous"
            href="#"
            :disabled="currentPage === 1"
        >
            <span aria-hidden="true">&laquo;</span>
        </CPaginationItem>

        <CPaginationItem
            v-for="page in pages"
            :key="page"
            :active="currentPage === page"
            @click="getRegalias(page)"
        >
            {{ page }}
        </CPaginationItem>

        <CPaginationItem
            @click="increasePage"
            aria-label="Next"
            href="#"
            :disabled="currentPage === lastPage"
        >
            <span aria-hidden="true">&raquo;</span>
        </CPaginationItem>
    </CPagination> -->
</template>

<script>
export default {
    name: "Regalias",
    data() {
        return {
            regalias: [],
            // lastPage: null,
            // currentPage: 0,
            // perPage: 20,
        };
    },
    mounted() {
        this.getRegalias();
    },
    methods: {
        // checkNumberInput() {
        //     // Only allow numbers
        //     this.searchInput = this.searchInput.replace(/[^0-9]/g, "");
        // },
        // search() {
        //     if (this.searchInput == null) {
        //         this.searchAlert = true;
        //         setTimeout(()=>{ this.searchAlert = false }, 3000);
        //         console.log("sI is null");
        //         return;
        //     }

        //     if (this.searchInput.length == 0) {
        //         this.getRegalias();
        //     }

        //     if (isNaN(this.searchInput)) {
        //         this.searchAlert = true;
        //         setTimeout(()=>{ this.searchAlert = false }, 3000);
        //         console.log("sI is not a number");
        //         return;
        //     }

        //     axios
        //         .post("/api/get-images-admin", {
        //             search: this.searchInput,
        //         })
        //         .then((response) => {
        //             this.images = response.data.images;
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        // // increasePage() {
        // //     this.currentPage += 1;
        // //     this.getRegalias(this.currentPage);
        // // },
        // // decreasePage() {
        // //     this.currentPage -= 1;
        // //     this.getRegalias(this.currentPage);
        // // },
        getRegalias() {
            // if (this.currentPage - 1 >= this.lastPage) {
            //     return;
            // }

            axios
                .post("/api/get-regalia", {
                    // currentPage: this.currentPage,
                    // perPage: this.perPage,
                })
                .then((response) => {
                    this.regalias = response.data.regalia;
                    // this.lastPage = response.data.lastPage;
                    // this.currentPage += 1;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteRegalia(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-regalia", { id: id }).then((response) => {
                    this.getRegalias();
                    console.log(response.data.message);
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
