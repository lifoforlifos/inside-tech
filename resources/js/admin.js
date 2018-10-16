import Vue from 'vue'
import axios from 'axios'

import App from './Admin/App.vue'
import router from './Admin/router'

require('./bootstrap');

const app = new Vue({
    el: '#admin',
    template: '<app></app>',
    components: {App},
    router
});
