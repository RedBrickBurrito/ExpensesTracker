require("./bootstrap");
import vue from "vue";
import VueSimpleAlert from "vue-simple-alert";
window.Vue = vue;

import App from "./components/App.vue";

//importamos Axios
import VueAxios from "vue-axios";
import axios from "axios";

//Importamos y configuramos el Vue-router
import VueRouter from "vue-router";
import { routes } from "./routes";
import Vue from "vue";

import store from '../src/store';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSimpleAlert);

Vue.prototype.$axios = axios;

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes: routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    if(to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/');
        return;
    }
    next();
})

//finalmente, definimos nuestra app de Vue
const app = new Vue({
    el: "#app",
    router: router,
    store,
    created() {
        const userInfo = localStorage.getItem('user');
        if(userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit('setUserData', userData);
        }
    },
    render: (h) => h(App),
});
