import { createApp } from 'vue'
import './style.css'
import App from './App.vue';
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import router from "@/routes/index.js";
import axios from "axios";
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';

axios.defaults.baseURL = "http://localhost:8000/api";

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(PrimeVue);
app.mount('#app');
