<template>
    <li v-if="item.rule == null || (user && user.rules[item.rule])" :class="{ active: active }">
        <a href="#" v-if="item.subItems" @click.prevent="onClick">
            <i class="fa" :class="item.icon"></i> 
            <span class="nav-label">{{ item.title }}</span>
            <span v-if="item.subItems" class="fa arrow"></span>
        </a>
        <router-link v-else :to="{ name: item.name, params: { } }">
            <i class="fa" :class="item.icon"></i> 
            <span class="nav-label">{{ item.title }}</span>
            <span v-if="item.subItems" class="fa arrow"></span>
        </router-link>
        <ul v-if="item.subItems" class="nav nav-second-level" :class="{ collapse: !active }">
            <li v-for="subItem in item.subItems" :key="item.name + '_' + subItem.name">
                <MenuSubItem v-if="user && user.rules[subItem.rule]" :subItem="subItem"/>
            </li>
        </ul>
    </li>
</template>

<script>

import MenuSubItem from './MainMenuSubItem.vue';

export default {
    components: {
        MenuSubItem
    },
    data() {
        return {
            active: false,
        }
    },
    methods: {
        haveActiveSubItem() {
            if(this.item.subItems) {
                for(const subItem of this.item.subItems) {
                    if(subItem.name == this.nav.current.name) {
                        this.active = true;
                        return ;
                    }
                }
            }
        },
        onClick() {
            if(this.item.subItems)
                this.active = !this.active;
        },
        onSubClick(name) {
            this.nav.changePage(name);
        }
    },
    mounted() {
        // this.haveActiveSubItem();
    },
    props: ['item', 'user'],
}
</script>