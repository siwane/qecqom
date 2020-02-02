import Vue from 'vue'
import router from './router/'
import App from './App'
import "babel-polyfill";

Vue.config.productionTip = false;

let app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
});