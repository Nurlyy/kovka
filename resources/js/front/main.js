// import { createApp } from 'vue'
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './App.vue'
import router from './router'
import axios from "axios";

const app = createApp(App)
app.use(router)
// app.use(axios)
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

app.mount('#app')
