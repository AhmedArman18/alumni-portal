import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../components/home/Home.vue';
import RouterView from '../components/home/RouterView.vue';
import VModal from 'vue-js-modal'
//import vue-select2-component
import Select2 from 'v-select2-component';

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

window.axios = require('axios');


Vue.use(Toast);

Vue.component('Select2', Select2);

// Vue.use(VModal);
// Vue.use(VModal, {
//     componentName: "dialog", dialog: true
// });

Vue.use(VModal, { dialog: true })

Vue.use(VueRouter);

const routes = [{
    path: '/', name: 'Home', component: Home,
},];

const router = new VueRouter({
    mode: 'history', routes,
});


new Vue({
    el: '#home-main-content', router, render: h => h(RouterView),
});
