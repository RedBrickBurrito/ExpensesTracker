const Home = () => import("./components/Home.vue");
const Contact = () => import("./components/Contact.vue");
//importamos los componentes para expense
const Show = () => import("./components/expense/Show.vue");
const Create = () => import("./components/expense/Create.vue");
const Edit = () => import("./components/expense/Edit.vue");

export const routes = [
    {
        name: "home",
        path: "/",
        component: Home,
    },
    {
        name: "showExpenses",
        path: "/expenses",
        component: Show,
    },
    {
        name: "createExpense",
        path: "/create",
        component: Create,
    },
    {
        name: "editExpense",
        path: "/edit/:id",
        component: Edit,
    },
    {
        name: "contact",
        path: "/contact",
        component: Contact,
    },
];
