<template>
    <router-link :to="{ name: subItem.name, params: {} }">{{ subItem.title }}</router-link>
    <!-- <a></a> -->
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    mounted() {
        // this.haveActiveSubItem();
    },
    props: ['subItem'],
}
</script>