<script>
    import { defineAsyncComponent } from "vue";

    import Dashboard from './dashboard/Dashboard.vue'; 
    // const Users = defineAsyncComponent (() => import('./users/List.vue'));
    // const AddUser = defineAsyncComponent (() => import('./users/Add.vue'));
    // const EditUser = defineAsyncComponent (() => import('./users/Edit.vue'));
    const Users = () => import('./users/List.vue');
    const AddUser = () => import('./users/Add.vue');
    const EditUser = () => import('./users/Edit.vue');
    const Roles = () => import('./roles/List.vue');
    const AddRole = () => import('./roles/Add.vue');
    const EditRole = () => import('./roles/Edit.vue');
    const Login = () => import('./auth/login.vue');
    import Page404 from './404/404.vue';

    const routes = [
        {
            name: 'main',
            path: '/',
            component: Dashboard,
        },
        {
            name: 'login',
            path: '/login',
            component: Login,
        },
        {
            name: 'users.list',
            path: '/users',
            component: Users,
        },
        {
            name: 'users.add',
            path: '/users/add',
            component: AddUser,
        },
        {
            name: 'users.edit',
            path: '/users/:id',
            component: EditUser,
        },
        {
            name: 'roles.list',
            path: '/roles',
            component: Roles,
        },
        {
            name: 'roles.add',
            path: '/roles/add',
            component: AddRole,
        },
        {
            name: 'roles.edit',
            path: '/roles/:id',
            component: EditRole,
        }
    ];

    export default {
        routes: routes,
    }
</script>

