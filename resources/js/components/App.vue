<template>
    <Sidebar :user="user"/>
    <div id="page-wrapper" class="gray-bg">
        <Header/>
        <div>
            <h1>Vue 3 App</h1>
        </div>
        <Footer/>
    </div>
    
</template>

<script>
import Header from "./basic/Header.vue";
import Footer from "./basic/Footer.vue";
import Sidebar from "./basic/Sidebar.vue";

export default{
    data() { 
        return {
            user: {
                name: 'Loading',
                role: 'Loading',
            },
        }
    },
    components: {
        Header,
        Footer,
        Sidebar
    },
    methods: {
        async fetchInfo() {
            try {
                const url = '/vue_api/user_info';
                const result = await axios.get(url);
                // console.log(response);
                // console.log(response.data);
                this.user = result.data;
            }
            catch(error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.fetchInfo();
    }
}

</script>