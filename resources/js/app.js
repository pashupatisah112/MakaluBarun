require('./bootstrap');

window.Vue = require('vue').default;

import App from './Pages/App'
import vuetify from "./vuetify";
import router from "./router";
import style from "../css/style.css";

import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'
Vue.use(SequentialEntrance);

Vue.use(require('vue-moment'));

import VueSocialSharing from 'vue-social-sharing'

Vue.use(VueSocialSharing);

new Vue({
    el: "#app",
    router,
    vuetify,
    style,
    components: {
        app: App
    }
});