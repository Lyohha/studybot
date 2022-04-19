<template>
    <!--<img alt="image" class="rounded-circle" src="/images/profile_small.jpg"/>-->
    <li class="nav-header">
        <div id="profile-info" class="dropdown profile-element">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="block m-t-xs font-bold">{{ user.name }}</span>
                <span class="text-muted text-xs block">{{ user.role }}</span>
            </a>
        </div>
                        
        <div class="logo-element">
            LCMS
        </div>
    </li>
    <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a class="dropdown-item" href="/logout">Logout</a></li>
    </ul>-->
</template>

<script>
    import axios from "axios"

    export default {
        // data() {
        //     return {
        //         name: "Loading",
        //         role: "Loading",
        //     };
        // },
        props: ['user'],
        methods: {
            async fetchInfo() {
                try {
                    const url = '/vue_api/user_info';
                    const result = await axios.get(url);
                    // console.log(response);
                    // console.log(response.data);
                    this.name = result.data.name;
                    this.role = result.data.role;
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