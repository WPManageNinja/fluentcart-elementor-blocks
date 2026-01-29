import Dashboard from './Components/Dashboard.vue';

export var routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            active_menu: 'dashboard'
        }
    }
];

