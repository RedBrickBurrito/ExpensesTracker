const Home = () => import("./components/Home.vue");
//importamos los componentes para expense
const Show = () => import("./components/expense/Show.vue");
const Create = () => import("./components/expense/Create.vue");
const Edit = () => import("./components/expense/Edit.vue");
const Login = () => import("./components/pages/Login.vue");
const Register = () => import("./components/pages/Register.vue");

export const routes = [
    {
        name: "login",
        path: "/",
        component: Login,
    },
    {
        name: "register",
        path: "/register",
        component: Register,
    },
    {
        name: "home",
        path: "/home",
        meta: {
            auth: true
        },
        component: Home,
    },
    {
        name: "showExpenses",
        path: "/expenses",
        meta: {
            auth: true
        },
        component: Show,
    },
    {
        name: "createExpense",
        path: "/create",
        meta: {
            auth: true
        },
        component: Create,
    },
    {
        name: "editExpense",
        path: "/edit/:id",
        meta: {
            auth: true
        },
        component: Edit,
    },
];
