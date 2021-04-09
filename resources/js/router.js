import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// ADMIN compents import
import AdminLogin from "./Pages/Admin/Login";
import AdminMain from "./Pages/Admin/Index";
import Dashboard from "./Pages/Admin/Home";
import AdminProjects from "./components/Admin/Home/Projects";
import Slider from "./components/Admin/Home/Slider";
import Messages from "./components/Admin/Home/Messages";
import Subscribers from "./components/Admin/Home/Subscribers";
import AdminGallery from "./components/Admin/Home/Gallery";
import AdminMemory from "./components/Admin/Home/Memory";

//User components import
import Main from "./Pages/User/Index";
import Home from "./Pages/User/Home";
import About from "./Pages/User/About";
import Project from "./Pages/User/Projects";
import Gallery from "./Pages/User/Gallery";
import Contact from "./Pages/User/Contact";
import ProjectDetail from "./Pages/User/ProjectDetail";

const routes = [
    // 
    {
        path: "/ma-login",
        name: "AdminLogin",
        component: AdminLogin
    },

    {
        path: "/ma-admin",
        component: AdminMain,
        children: [
            {
                path: "dashboard",
                name: "AdminDashboard",
                component: Dashboard
            },

            {
                path: "projects",
                name: "AdminProjects",
                component: AdminProjects
            },

            {
                path: "gallery",
                name: "AdminGallery",
                component: AdminGallery
            },
            {
                path: "memory",
                name: "AdminMemory",
                component: AdminMemory
            },
            {
                path: "slider",
                name: "Slider",
                component: Slider
            },
            {
                path: "messages",
                name: "Messages",
                component: Messages
            },
            {
                path: "subscribers",
                name: "Subscribers",
                component: Subscribers
            }
        ]
    },
    {
        path: "/home",
        redirect: "/"
    },
    {
        path: "/",
        component: Main,
        children: [
            {
                path: "",
                name: "Home",
                component: Home
            },
            {
                path: "about",
                name: "About",
                component: About
            },
            {
                path: "projects/:key",
                name: "ProjectList",
                component: Project
            },
            {
                path: "contact-us",
                name: "Contact",
                component: Contact
            },
            {
                path: "gallery",
                name: "Gallery",
                component: Gallery
            },
            {
                path: "/project/:id/:title",
                name: "Project-Detail",
                component: ProjectDetail
            }
        ]
    }
];
const userRoutes = [];
const router = new VueRouter({
    mode: "history",//redirect to common route. see web route last line or you will face error on page refresh
    scrollBehavior: function(to, from, savedPosition) {
        if (to.hash) {
            return { selector: to.hash,behavior:'smooth' };
        } else {
            return { x: 0, y: 0 };
        }
    },
    //for history mode
    base:'/',//send axios request like this..use '/' first (/api/getSomething) otherwise data will not be fetched for route params
    routes
}); //global token check for authorization [mode: 'history',]add this to remo hashtag mode
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    window.axios.defaults.headers["Authorization"] = "Bearer " + token;
    next();
});
export default router;
