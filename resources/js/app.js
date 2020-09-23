import Vue from 'vue';
import router from './router/router.js'

require('./bootstrap');

Vue.component('Navbar', require('./components/Partials/Navbar.vue').default);

const app = new Vue({
    el: '#app',
    router
});
