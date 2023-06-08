<template>
    <div v-if="isLoading" class="loading-overlay">
        <CButton disabled>
            <CSpinner
                component="span"
                size="xsl"
                color="light"
                aria-hidden="true"
            />
        </CButton>
    </div>
    <h1 v-if="id == null">Добавить Вкладку</h1>
    <h1 v-if="id != null">Изменить Вкладку</h1>
    <CForm @submit.prevent="submitForm()">
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

        <div class="mb-3">
            <CFormLabel for="title">Текст вкладки</CFormLabel>
            <CFormTextarea
                v-model="body"
                :value="body"
                id="body"
                rows="3"
            ></CFormTextarea>
        </div>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 1)"
            v-model="show1"
            :width="1200"
            :height="900"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 2)"
            v-model="show2"
            :width="1200"
            :height="800"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 3)"
            v-model="show3"
            :width="1200"
            :height="800"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 4)"
            v-model="show4"
            :width="1200"
            :height="800"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 5)"
            v-model="show5"
            :width="1200"
            :height="800"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <my-upload
            field="img"
            @crop-success="(img, field) => cropSuccess(img, field, 6)"
            v-model="show6"
            :width="1200"
            :height="800"
            :params="params"
            :langType="ru"
            :headers="headers"
            img-format="png"
        ></my-upload>

        <div class="mb-3">
            <CCard>
                <CCardBody class="mb-3">
                    <CCardTitle>1 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image1 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview1"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue1 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview1_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue1 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image1 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible1 = !visible1"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible1">
                                    <CCard
                                        v-show="image1 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview1',
                                                            filter,
                                                            1
                                                        );
                                                        filterValue1 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue1 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview1_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow1()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
                    <CCardTitle>2 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image2 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview2"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue2 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview2_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue1 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image2 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible2 = !visible2"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible2">
                                    <CCard
                                        v-show="image2 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview2',
                                                            filter,
                                                            2
                                                        );
                                                        filterValue2 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue2 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview2_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow2()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
                    <CCardTitle>3 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image3 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview3"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue3 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview3_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue3 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image3 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible3 = !visible3"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible3">
                                    <CCard
                                        v-show="image3 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview3',
                                                            filter,
                                                            3
                                                        );
                                                        filterValue3 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue3 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview3_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow3()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
                    <CCardTitle>4 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image4 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview4"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue4 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview4_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue4 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image4 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible4 = !visible4"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible4">
                                    <CCard
                                        v-show="image4 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview4',
                                                            filter,
                                                            4
                                                        );
                                                        filterValue4 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue4 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview4_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow4()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
                    <CCardTitle>5 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image5 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview5"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue5 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview5_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue5 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image5 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible5 = !visible5"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible5">
                                    <CCard
                                        v-show="image5 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview5',
                                                            filter,
                                                            5
                                                        );
                                                        filterValue5 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue5 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview5_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow5()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
                    <CCardTitle>6 Изображение</CCardTitle>
                    <CContainer>
                        <CRow>
                            <CCol xs="6">
                                <CCard
                                    v-show="image6 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview6"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>Оригинал</p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="6">
                                <CCard
                                    v-show="filterValue6 != null"
                                    style="
                                        text-align: center;
                                        justify-content: center;
                                    "
                                >
                                    <CCardBody
                                        style="
                                            display: flex;
                                            justify-content: center;
                                        "
                                    >
                                        <div>
                                            <img
                                                id="imagePreview6_filtered_selected"
                                                alt="Preview Image"
                                                class="mb-3 preview_image"
                                            />
                                            <p>
                                                <strong>Фильтр: </strong
                                                >{{ filterValue6 }}
                                            </p>
                                        </div>
                                    </CCardBody>
                                </CCard>
                            </CCol>
                            <CCol xs="12" v-show="image6 != null">
                                <div
                                    style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: center;
                                        margin: 15px;
                                    "
                                >
                                    <CButton
                                        color="light"
                                        href="#"
                                        @click="visible6 = !visible6"
                                        >Доступные фильтры</CButton
                                    >
                                </div>
                                <CCollapse :visible="visible6">
                                    <CCard
                                        v-show="image6 != null"
                                        style="text-align: center"
                                    >
                                        <CCardBody>
                                            <CRow>
                                                <div
                                                    v-for="(
                                                        filter, index
                                                    ) in filters"
                                                    :key="index"
                                                    @click="
                                                        selectFilter(
                                                            'imagePreview6',
                                                            filter,
                                                            6
                                                        );
                                                        filterValue6 = filter;
                                                    "
                                                    :style="{
                                                        border:
                                                            filterValue6 ===
                                                            filter
                                                                ? '1px solid'
                                                                : 'none',
                                                    }"
                                                    style="
                                                        background-color: #e5e5e5;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview6_filtered_' +
                                                            index
                                                        "
                                                        class='preview_filter_image'
                                                    />
                                                    <p>{{ filter }}</p>
                                                </div>
                                            </CRow>
                                        </CCardBody>
                                    </CCard>
                                </CCollapse>
                            </CCol>
                        </CRow>
                    </CContainer>

                    <CButton
                        class="mt-3"
                        color="light"
                        href="#"
                        @click="toggleShow6()"
                        >{{ buttonText }}</CButton
                    >
                </CCardBody>
            </CCard>
        </div>

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
import applyFilter from "../assets/pixels/script";
import myUpload from "vue-image-crop-upload";
export default {
    name: "AddPage",
    components: {
        "my-upload": myUpload,
        //  VueCropper
    },
    data() {
        return {
            show1: false,
            show2: false,
            show3: false,
            show4: false,
            show5: false,
            show6: false,

            params: {
                token: "123456798",
                name: "avatar",
            },
            headers: {
                smail: "*_~",
            },
            imgDataUrl: "",
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
            filterValue1: null,
            filterValue2: null,
            filterValue3: null,
            filterValue4: null,
            filterValue5: null,
            filterValue6: null,
            filters: ["darkify", "pane"],
            visible1: false,
            visible2: false,
            visible3: false,
            visible4: false,
            visible5: false,
            visible6: false,
            image_id: null,
            isLoading: false,
        };
    },
    methods: {
        toggleShow1() {
            this.image_id = 1;
            this.show1 = !this.show1;
        },
        toggleShow2() {
            this.image_id = 2;
            this.show2 = !this.show2;
        },
        toggleShow3() {
            this.image_id = 3;
            this.show3 = !this.show3;
        },
        toggleShow4() {
            this.image_id = 4;
            this.show4 = !this.show4;
        },
        toggleShow5() {
            this.image_id = 5;
            this.show5 = !this.show5;
        },
        toggleShow6() {
            this.image_id = 6;
            this.show6 = !this.show6;
        },
        /**
         * crop success
         *
         * [param] imgDataUrl
         * [param] field
         */
        cropSuccess(imgDataUrl, field, id) {
            console.log("-------- crop success with id=" + id + " --------");
            this.imgDataUrl = imgDataUrl;
            // this.preview.src = imgDataUrl;
            this.saveImage(imgDataUrl, id);
        },
        changeVisibility() {
            this.is_visible = !this.is_visible;
        },
        submitForm() {
            this.isLoading = true;
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
                axios.post("/api/update-tab", formData).then((response) => {
                    console.log(response.data);
                    this.isLoading = false;
                    router.push({ name: "Tabs" });
                });
            } else {
                axios.post("/api/create-tab", formData).then((response) => {
                    console.log(response.data);
                    this.isLoading = false;
                    router.push({ name: "Tabs" });
                });
                // alert("saved");
            }
        },
        saveImage(event, number) {
            var preview;
            var image_id = "";

            const base64Data = event.split(",")[1]; // Remove the data URL prefix
            const byteCharacters = atob(base64Data);
            const byteArrays = [];
            for (let i = 0; i < byteCharacters.length; i++) {
                byteArrays.push(byteCharacters.charCodeAt(i));
            }
            const blob = new Blob([new Uint8Array(byteArrays)], {
                type: "image/png",
            });
            const file = new File(
                [blob],
                "image_" +
                    Math.floor(Math.random() * (10000 - 1 + 1)) +
                    1 +
                    ".png",
                { type: blob.type }
            );
            switch (number) {
                case 1:
                    this.image1 = file;
                    preview = document.getElementById("imagePreview1");
                    image_id = "imagePreview1";
                    break;
                case 2:
                    this.image2 = file;
                    preview = document.getElementById("imagePreview2");
                    image_id = "imagePreview2";
                    break;
                case 3:
                    this.image3 = file;
                    preview = document.getElementById("imagePreview3");
                    image_id = "imagePreview3";
                    break;
                case 4:
                    this.image4 = file;
                    preview = document.getElementById("imagePreview4");
                    image_id = "imagePreview4";
                    break;
                case 5:
                    this.image5 = file;
                    preview = document.getElementById("imagePreview5");
                    image_id = "imagePreview5";
                    break;
                case 6:
                    this.image6 = file;
                    preview = document.getElementById("imagePreview6");
                    image_id = "imagePreview6";
                    break;
            }
            preview.src = event;
            preview.style.display = "block";

            setTimeout(() => {
                // preview.src = applyFilter(image_id)
                this.filters.forEach((filter, index) => {
                    applyFilter(
                        image_id,
                        image_id + "_filtered_" + index,
                        filter
                    );
                });

                // preview.width = preview.naturalWidth;
                // preview.height = preview.naturalHeight;
            }, 500);
        },
        change({ coordinates, canvas }) {
            console.log(coordinates, canvas);
        },
        selectFilter(id, filter, number) {
            var dataUrl = applyFilter(id, id + "_filtered_selected", filter);
            // var reader = new FileReader();
            console.log(dataUrl);
            // var readDataUrl = reader.readAsDataURL(dataUrl);
            var readDataUrl = dataUrl;
            switch (number) {
                case 1:
                    this.image1 = readDataUrl;
                    break;
                case 2:
                    this.image2 = readDataUrl;
                    break;
                case 3:
                    this.image3 = readDataUrl;
                    break;
                case 4:
                    this.image4 = readDataUrl;
                    break;
                case 5:
                    this.image5 = readDataUrl;
                    break;
                case 6:
                    this.image6 = readDataUrl;
                    break;
            }
        },
        convertSrcToFile(src) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", src, true);
                xhr.responseType = "blob";

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        const blob = xhr.response;
                        const file = new File([blob], "image.png", {
                            type: "image/png",
                        });
                        resolve(file);
                    } else {
                        reject(
                            new Error("Failed to convert image src to file")
                        );
                    }
                };

                xhr.onerror = () => {
                    reject(new Error("Failed to convert image src to file"));
                };

                xhr.send();
            });
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
    computed: {
        buttonText: function () {
            if (this.id === null) {
                return "Добавить изображение";
            } else {
                return "Изменить изображение";
            }
        },
    },
};
</script>
<style scoped>
.preview_image {
    max-height: 400px;
    max-width: 400px;
    
    border-radius: 15px;
    margin-top: 15;
    display: none;
}

.preview_filter_image {
    height: 75px;
    border-radius: 15px;
    margin-top: 15;
    display: none;
}

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
