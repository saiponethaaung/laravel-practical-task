import Vue from 'vue';
import './configuration/bootstrap';
import App from './components/App.vue';

Vue.component('app', App)

new Vue({
    el: '#app'
});
