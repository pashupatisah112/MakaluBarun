import Vue from "vue";
import Vuetify from "vuetify";
import colors from "vuetify/lib/util/colors";

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                error: "#FF5252",
                info: "#2196F3",
                success: "#4CAF50",
                warning: "#FFC107",
                accent: colors.shades.black,
                white:"#ffffff",
                black:"#000000",
                prime:"#009E9A;",
                sec:"#F77D4D"
               
            },
            dark: {
                primary: colors.blue.lighten3
            }
        }
    }
});
