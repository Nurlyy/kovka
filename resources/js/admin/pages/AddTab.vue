<template>
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

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview1_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview1',
                                                                filter, 1
                                                            );
                                                            filterValue1 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image1"
                        >Изображение №1</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image1"
                        >Изменить изображение №1</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 1);
                            filterValue1 = null;
                        "
                        type="file"
                        id="image1"
                    />
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview2_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview2',
                                                                filter, 2
                                                            );
                                                            filterValue2 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image2"
                        >Изображение №2</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image2"
                        >Изменить изображение №2</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 2);
                            filterValue2 = null;
                        "
                        type="file"
                        id="image2"
                    />
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview3_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview3',
                                                                filter, 3
                                                            );
                                                            filterValue3 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image1"
                        >Изображение №3</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image1"
                        >Изменить изображение №3</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 3);
                            filterValue3 = null;
                        "
                        type="file"
                        id="image3"
                    />
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview4_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview4',
                                                                filter, 4
                                                            );
                                                            filterValue4 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image4"
                        >Изображение №4</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image4"
                        >Изменить изображение №4</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 4);
                            filterValue4 = null;
                        "
                        type="file"
                        id="image4"
                    />
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview5_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview5',
                                                                filter, 5
                                                            );
                                                            filterValue5 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image5"
                        >Изображение №5</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image5"
                        >Изменить изображение №5</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 5);
                            filterValue5 = null;
                        "
                        type="file"
                        id="image5"
                    />
                </CCardBody>
            </CCard>
        </div>

        <div class="mb-3">
            <CCard>
                <CCardBody>
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                style="
                                                    height: 150px;
                                                    border-radius: 15px;
                                                    margin-top: 15;
                                                    display: none;
                                                "
                                                class="mb-3"
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
                                                    style="
                                                        background-color: lightgray;
                                                        border-radius: 15px;
                                                        padding: 5px;
                                                        width: fit-content;
                                                        margin: 5px;
                                                    "
                                                >
                                                    <img
                                                        :id="
                                                            'imagePreview6_filtered_' +
                                                            index
                                                        "
                                                        style="
                                                            height: 100px;
                                                            border-radius: 15px;
                                                            margin-top: 15;
                                                            display: none;
                                                        "
                                                        @click="
                                                            selectFilter(
                                                                'imagePreview6',
                                                                filter, 6
                                                            );
                                                            filterValue6 =
                                                                filter;
                                                        "
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

                    <CFormLabel v-if="id == null" for="image6"
                        >Изображение №6</CFormLabel
                    >
                    <CFormLabel v-if="id != null" for="image6"
                        >Изменить изображение №6</CFormLabel
                    >
                    <CFormInput
                        @change="
                            saveImage($event, 6);
                            filterValue6 = null;
                        "
                        type="file"
                        id="image6"
                    />
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
export default {
    name: "AddPage",
    data() {
        return {
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
        };
    },
    methods: {
        changeVisibility() {
            this.is_visible = !this.is_visible;
        },
        submitForm() {
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
                axios
                    .post("/api/update-tab", formData)
                    .then(function (response) {
                        console.log(response.data);
                    });
            } else {
                axios
                    .post("/api/create-tab", formData)
                    .then(function (response) {
                        console.log(response.data);
                    });
                // alert("saved");
            }
            setTimeout(() => {
                router.push({ name: "Tabs" });
            }, 500);
        },
        saveImage(event, number) {
            var preview;
            var image_id = "";
            switch (number) {
                case 1:
                    this.image1 = event.target.files[0];
                    preview = document.getElementById("imagePreview1");
                    image_id = "imagePreview1";
                    break;
                case 2:
                    this.image2 = event.target.files[0];
                    preview = document.getElementById("imagePreview2");
                    image_id = "imagePreview2";
                    break;
                case 3:
                    this.image3 = event.target.files[0];
                    preview = document.getElementById("imagePreview3");
                    image_id = "imagePreview3";
                    break;
                case 4:
                    this.image4 = event.target.files[0];
                    preview = document.getElementById("imagePreview4");
                    image_id = "imagePreview4";
                    break;
                case 5:
                    this.image5 = event.target.files[0];
                    preview = document.getElementById("imagePreview5");
                    image_id = "imagePreview5";
                    break;
                case 6:
                    this.image6 = event.target.files[0];
                    preview = document.getElementById("imagePreview6");
                    image_id = "imagePreview6";
                    break;
            }

            // Create a new FileReader instance
            var reader = new FileReader();

            // Set the image preview source
            reader.onload = function (event) {
                preview.src = event.target.result;
            };

            preview.style.display = "block";

            // Read the image file as a data URL
            reader.readAsDataURL(event.target.files[0]);

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
        selectFilter(id, filter, number) {
            var dataUrl = applyFilter(id, id + "_filtered_selected", filter);
            // var reader = new FileReader();
            // console.log(dataUrl);
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
};
</script>

<style></style>
