require('./bootstrap');

window.Vue = require('vue').default;

import App from './Pages/App'
import vuetify from "./vuetify";
import router from "./router";
import style from "../css/style.css";
 

new Vue({
    el: "#app",
    //i18n,
    router,
    vuetify,
    style,
    //store,
    components: {
        app: App
    }
});