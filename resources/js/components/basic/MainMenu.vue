<template>
    <MenuItem v-for="item in items" :key="item.name" :item="item" :user="user" />
</template>

<script>
    import axios from "axios"
    import MenuItem from "./MainMenuItem.vue"

    export default {
        components: {
            MenuItem,
        },
        data() {
            return { 
                items: [
                    {
                        name: 'main',
                        title: 'Dashboard',
                    },
                    {
                        name: 'users.list',
                        title: 'Users',
                        icon: 'fa-link',
                        rule: 'edit_users',
                        subItems: [
                            {
                                name: 'users.list',
                                title: 'Users List',
                                rule: 'edit_users',
                            },
                            {
                                name: 'users.add',
                                title: 'Add User',
                                rule: 'edit_users',
                            }
                        ]
                    },
                    {
                        name: 'roles.list',
                        title: 'Roles',
                        icon: 'fa-link',
                        rule: 'edit_roles',
                        subItems: [
                            {
                                name: 'roles.list',
                                title: 'Roles List',
                                rule: 'edit_roles',
                            },
                            {
                                name: 'roles.add',
                                title: 'Add Role',
                                rule: 'edit_roles',
                            }
                        ]
                    }
                ] 
            };
        },
        methods: {
            async fetchInfo() {
                try {
                    const url = '/vue_api/user_menu';
                    const result = await axios.get(url);
                    // console.log(response);
                    console.log(result.data);
                    this.items = result.data;
                }
                catch(error) {
                    console.log(error);
                }
            },
        },
        mounted() {
            // this.fetchInfo();
        },
        props: ['user']
    }
</script>