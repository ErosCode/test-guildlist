require('./bootstrap');

import Vue from 'vue'
import router from './router'
import App from './views/app.vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});


