<template>
    <li v-for="item in items" :class="{ active: item.url == active }">
        <a v-bind:href="item.url">
            <i class="fa" :class="item.icon"></i> 
            <span class="nav-label">{{ item.name }}</span>
            <span class="fa arrow"></span>
        </a>
            <ul class="nav nav-second-level">
                <li v-for="subitem in item.submenu" :class="{ active: subitem.url == active }">
                    <a  v-bind:href="subitem.url">{{ subitem.name }}</a>
                </li>
            </ul>
    </li>
</template>

<script>
    import axios from "axios"

    export default {
        components: {
        },
        data() {
            return {
                items: [],
                active: '/test',
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
            }
        },
        mounted() {
            // this.fetchInfo();
        }
    }
</script>