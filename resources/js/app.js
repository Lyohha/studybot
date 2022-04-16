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
createApp(App).mount('#app');
