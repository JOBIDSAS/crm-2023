import Vue from "vue";
import VueRouter from 'vue-router';

import Dashboard from "../pages/Dashboard";
import Profile from "../pages/Profile";
import Test from "../pages/Test";

import Leads from "../pages/commercial/Leads";
import Contacts from "../pages/commercial/Contacts";
import Calendar from "../pages/commercial/Calendar";

import Extractor from "../pages/supervisor/Extractor";
import Confirmators from "../pages/supervisor/Confirmators";
import Teleprospectors from "../pages/supervisor/Teleprospectors";
import Reminder from "../pages/supervisor/Reminder";
import Clients from "../pages/supervisor/Clients";

import Portfolio from "../pages/Portfolio";
import Info from "../pages/Info";
import Settings from "../pages/Settings";
import Sign from "../pages/Sign";
import axios from "axios";
import requester from "./requester";


Vue.use(VueRouter);

let router = new VueRouter({
    mode:"history",
    routes:[
        { 
            path: '', 
            redirect: '/dashboard'
        },
        { 
            path: '/signout',
        },
        {
            path:'/signin', 
            name:"signin", 
            meta: { 
                title: "CPN - Connexion",
                requiresAuth: false,
            },  
            component:Sign,
        },
        {
            path:'/dashboard', 
            name:"dashboard", 
            meta: {
                title: "CPN - Tableau de bord", 
                requiresAuth: true,
            },  
            component:Dashboard,
        },
        {
            path:'/profile', 
            name:"profile", 
            meta: { 
                title: "CPN - Profile",
                requiresAuth: true,
            },  
            component:Profile,
        },
        {
            path:'/test', 
            name:"test", 
            meta: { 
                title: "CPN - Test d'éligibilité",
                requiresAuth: true,
            },  
            component:Test,
        },
        {
            path:'/leads', 
            name:"leads", 
            meta: { 
                title: "CPN - Leads contact",
                requiresAuth: true,
             },  
            component:Leads,
        },
        {
            path:'/contacts', 
            name:"contacts", 
            meta: { 
                title: "CPN - Répertoire",
                requiresAuth: true,
            },  
            component:Contacts,
        },
        {
            path:'/calendar', 
            name:"calendar", 
            meta: { 
                title: "CPN - Agenda",
                requiresAuth: true,
            },  
            component:Calendar,
        },
        {
            path:'/portfolio', 
            name:"portfolio", 
            meta: { 
                title: "CPN - Portefeuille",
                requiresAuth: true,
            },  
            component:Portfolio,
        },
        {
            path:'/commercial', 
            name:"commercial", 
            meta: { 
                title: "CPN - Commercial",
                requiresAuth: true,
            },  
            component:Portfolio,
        },
        {
            path:'/extractor', 
            name:"extractor", 
            meta: { 
                title: "CPN - Extraction",
                requiresAuth: true,
            },  
            component:Extractor,
        },
        {
            path:'/info', 
            name:"info", 
            meta: { 
                title: "CPN - Info",
                requiresAuth: true,
            },  
            component:Info,
        },
        {
            path:'/settings', 
            name:"settings", 
            meta: { 
                title: "CPN - Réglages",
                requiresAuth: true,
            },  
            component:Settings,
        },

        {
            path:'/supervisor/confirmator', 
            name:"SupConfirmator", 
            meta: { 
                title: "CPN - Calendrier",
                requiresAuth: true,
            },  
            component:Confirmators,
        },
        {
            path:'/supervisor/reminder', 
            name:"SupReminder", 
            meta: { 
                title: "CPN - Calendrier",
                requiresAuth: true,
            },  
            component:Reminder,
        },
        {
            path:'/supervisor/teleprospector', 
            name:"teleprospector", 
            meta: { 
                title: "CPN - Téléprospecteurs",
                requiresAuth: true,
            },  
            component:Teleprospectors,
        },
        {
            path:'/supervisor/client', 
            name:"Clients", 
            meta: { 
                title: "CPN - CLients",
                requiresAuth: true,
            },  
            component:Clients,
        },
    ]
})

router.beforeEach((to, from, next) => {
    window.document.title = to.meta && to.meta.title ? to.meta.title : 'CPN';
    if(to.fullPath == "/signin" && localStorage.getItem("token")) next({path:"/dashboard"});
    if(to.matched.some(record=>record.meta.requiresAuth)){
        if(localStorage.getItem("token")){
            next();
        } else {
            next({ path: '/signin' });
        }
    } else {
        if(to.fullPath == "/signout"){
            if(localStorage.getItem("token")){
                requester.signout().then(response=>console.log(response.data)).catch(error=>console.log(error));
                router.app.$store.dispatch("userClear");
                localStorage.removeItem("token");
                next({path: '/signin'});
            } else {
                next({path: '/signin'})
            }
        }
        next();
    }
});

export default router;