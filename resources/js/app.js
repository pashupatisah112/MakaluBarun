require('./bootstrap');

window.Vue = require('vue').default;

import App from './Pages/App'
import vuetify from "./vuetify";
import router from "./router";
import style from "../css/style.css";
import 'froala-editor/css/froala_editor.pkgd.min.css' // all styles (also for buttons)
import 'froala-editor/js/plugins.pkgd.min' // all plugins (you can add plugins by one too)
// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)

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