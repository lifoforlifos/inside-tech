import Vue from 'vue'
import axios from 'axios'

import App from './App.vue'
import router from './Users/router'

require('./bootstrap');

const app = new Vue({
    el: '#root',
    template: '<app></app>',
    components: {App},
    router
});
