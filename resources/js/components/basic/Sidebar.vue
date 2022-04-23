<template>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
               <ProfileInfo :user="user"/>
               <MainMenu :user="user"/>
            </ul>

        </div>
    </nav>
</template>
<script>
    import ProfileInfo from "./ProfileInfo.vue";
    import MainMenu from "./MainMenu.vue";

    export default {
        components: {
            ProfileInfo,
            MainMenu
        },
        props: ['user']
    }
</script>