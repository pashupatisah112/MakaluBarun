import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// ADMIN compents import
import AdminLogin from "./Pages/Admin/Login";
import AdminMain from "./Pages/Admin/Index";
import Dashboard from "./Pages/Admin/Home";
import AdminStories from "./components/Admin/Home/Stories";
import AdminProjects from './components/Admin/Home/Projects';
import AdminTeams from './components/Admin/Home/Team';
import Slider from './components/Admin/Home/Slider';
import Messages from './components/Admin/Home/Messages';
import Subscribers from './components/Admin/Home/Subscribers';

//User components import
import Main from "./Pages/User/Index";
import Home from "./Pages/User/Home";
import About from './Pages/User/About';
import Project from './Pages/User/Projects';
import Blog from './Pages/User/BlogList';
import Contact from './Pages/User/Contact';

const routes = [
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
                path: "stories",
                name: "AdminStories",
                component: AdminStories
            },
            {
                path: "projects",
                name: "AdminProjects",
                component: AdminProjects
            },
            {
                path: "teams",
                name: "AdminTeams",
                component: AdminTeams
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
            },
        ]
    },
{
    path:'/home',
    redirect:'/'
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
                path: "about-us",
                name: "About",
                component: About
            },
            {
                path: "projects",
                name: "Project",
                component: Project
            },
            {
                path: "contact-us",
                name: "Contact",
                component: Contact
            },
            {
                path: "team",
                name: "Team",
                component: About
            },
            {
                path: "/blogs",
                name: "Blog",
                component: Blog
            },
        ]
    }
];
const userRoutes = [];
const router = new VueRouter({routes, userRoutes}); //global token check for authorization [mode: 'history',]add this to remo hashtag mode
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    window.axios.defaults.headers["Authorization"] = "Bearer " + token;
    next();
});
export default router;
