require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// import Vue from 'vue';

// const app = new Vue({
//     el: '#app'
// })
import { createApp } from "vue";

import App from "./components/App.vue";
import Navigation from "./components/Navigation.vue";
import Select from "./components/form/Select.vue";
import SelectMultiple from "./components/form/SelectMultiple.vue";
import { createWebHistory, createRouter } from "vue-router";

const router = createRouter({
    routes: Navigation.routes,
    history: createWebHistory(),
})


// createApp({
//     components: {
//         App,
//         ProfileInfo
//     }
// }).mount('#app');
// export default {
//     components: {
//         App,
//         ProfileInfo,
//     }
// }
const app = createApp(App);
app.use(router);
app.component('custom-select', Select);
app.component('custom-select-multiple', SelectMultiple);
app.mount("#wrapper");