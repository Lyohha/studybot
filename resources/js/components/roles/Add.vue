<template>
    <div v-if="user.rules.edit_roles" class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add role</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'main'}">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'roles.list'}">All roles</router-link>
                </li>
                <li class="breadcrumb-item">
                    Add
                </li>
            </ol>
        </div>
    </div>
    <form v-if="user.rules.edit_roles" method="POST" @submit.prevent="save" :class="{ disabled: editDisabled }">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div v-for="(message, index) in mainMessages" class="col-lg-12" :key="index">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-danger">{{ message }}</h5>
                            <div class="ibox-tools">
                                <a class="close-link" @click.prevent="closeMainMessage(index)">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Profile info</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" v-model="name"> 
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Rules</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">List</label>
                                <div class="col-sm-10">
                                    <custom-select-multiple v-model="rules" :items="items"></custom-select-multiple>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                confirmPassword: '',
                rules: [],
                items: {
                    edit_users: 'Edit users',
                    edit_roles: 'Edit roles',
                },
                editDisabled: false,
                passwordMessages: [],
                mainMessages: [],
            }
        },
        methods: {
            async save() {
                console.log('save');
                this.editDisabled = true;

                let data = {
                    name: this.name,
                    // rules: this.rules,
                };

                this.rules.forEach(value => {
                    data[value] = true;
                });

                try {
                    const result = await axios.post('/vue_api/roles', data);

                    console.log(result.data);

                    if(result.data.result == 'error') {
                        console.log(result.data.messages)
                    }
                    else if(result.data.result == 'ok') {
                        this.$router.push({ name: 'roles.edit', params: { id: result.data.user } })
                    }
                }
                catch(error) {
                    console.log(error);
                }

                this.editDisabled = false;
            },
            closeMainMessage(index) {
                this.mainMessages.splice(index, 1);
            },
        },
        mounted() {

        },
        props: ['user'],
    }
</script>

<style>
    .notify-padding {
        padding: 20px 10px 0px;
    }
</style>