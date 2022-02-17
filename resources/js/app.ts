import Vue from 'vue';
import './configuration/bootstrap';
import App from './components/App.vue';
import { BootstrapVue, FormPlugin, IconsPlugin, LayoutPlugin } from 'bootstrap-vue'
import router from './configuration/router';

Vue.use(BootstrapVue);
Vue.use(LayoutPlugin);
Vue.use(FormPlugin);
Vue.use(IconsPlugin);

Vue.component('app', App)

new Vue({
    router,
    el: '#app'
});
