require("./bootstrap");
import { createApp } from "vue";

import App from "./components/Welcome.vue";
import { createRouter, createWebHistory } from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import { routes } from "./routes";
console.log({ routes });

// vuedatepicker
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
console.log({router});

const app = createApp(App)
app.use(router);
app.use(VueAxios, axios);
app.component('VueDatePicker', VueDatePicker);
app.mount("#app");
