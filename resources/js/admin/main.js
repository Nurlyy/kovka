// import { createApp } from 'vue'
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './App.vue'
import router from './router'
import store from './store'

import './bootstrap';

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import  { cilLockLocked,
    cilSave,
    cilTrash,
    cilPen,
    cilPlus,
    cilSearch,
    cilImage,
    cilListFilter,
    cilContact,
    cilUser,
    cilFile,
    cilFeaturedPlaylist,
    cilAccountLogout,
    cilAlignCenter,
    cilMenu,
     } from '@coreui/icons'
// import VueEasyLightbox from 'vue-easy-lightbox';

import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'

import VueCropper from 'vue-cropper'; 
import 'vue-cropper/dist/index.css'

const app = createApp(App)
// app.use(VueEasyLightbox, {
    // maxZoom: 1.5,
    // maxWidth: window.innerWidth * 0.8,
    // maxHeight: window.innerHeight * 0.8,
    // zIndex: 9999
//   });
app.use(store)
app.use(mavonEditor)
app.use(router)
app.use(VueCropper)
app.use(CoreuiVue)
app.provide('icons', {cilContact, cilListFilter, cilLockLocked, cilSave, cilTrash, cilPen, cilPlus, cilSave, cilSearch, cilImage, cilUser, cilFeaturedPlaylist, cilFile, cilAccountLogout,cilAlignCenter,cilMenu});
app.component('CIcon', CIcon)

app.mount('#app')
