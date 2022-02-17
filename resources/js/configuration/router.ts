import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from '../components/pages/HomePage.vue';
import LoginPage from '../components/pages/LoginPage.vue';
import RegisterPage from '../components/pages/RegisterPage.vue';
import CreateSurveyPage from '../components/pages/CreateSurveyPage.vue';
import SurveyDetailPage from '../components/pages/SurveyDetailPage.vue';

Vue.use(VueRouter);

export default new VueRouter({
    base: '/',
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterPage
        },
        {
            path: '/login',
            name: 'login',
            component: LoginPage
        },
        {
            path: '/survey/create',
            name: 'survey.create',
            component: CreateSurveyPage
        },
        {
            path: '/survey/:surveyID',
            name: 'survey.detail',
            component: SurveyDetailPage
        },
    ],
});
