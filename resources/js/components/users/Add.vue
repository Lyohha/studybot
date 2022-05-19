<template>
    <div v-if="user.rules.edit_users" class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add user</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'main'}">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'users.list'}">All users</router-link>
                </li>
                <li class="breadcrumb-item">
                    Add
                </li>
            </ol>
        </div>
    </div>
    <form v-if="user.rules.edit_users" method="POST" @submit.prevent="save" :class="{ disabled: editDisabled }">
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
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" v-model="email"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="rules" required>
                                        @foreach($rules as $item)
                                            <option value="{{ $item->role }}" {{ isset($info['rules']) && $info['rules'] == $item->role ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Roles</label>
                                <div class="col-sm-10">
                                    <custom-select-multiple v-model="roles" :items="items"></custom-select-multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-for="(message, index) in passwordMessages" class="col-lg-12" :key="index">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-danger">{{ message }}</h5>
                            <div class="ibox-tools">
                                <a class="close-link" @click.prevent="closePasswordMessage(index)">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Security</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" required v-model="password"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Comfirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" required v-model="confirmPassword"> 
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
                roles: [],
                items: {},
                editDisabled: true,
                passwordMessages: [],
                mainMessages: [],
            }
        },
        methods: {
            async getRoles() {
                if(!this.user.rules.edit_users)
                    return;
                try {
                    const result = await axios.get('/vue_api/roles');
                    this.items = {};

                    for(let item in result.data.data) {
                        this.items[result.data.data[item].id] = result.data.data[item].name;
                    }

                    this.editDisabled = false;
                }
                catch(error) {
                    console.log(error);
                }
            },
            async save() {
                console.log('save');
                this.editDisabled = true;

                let data = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.confirmPassword,
                    roles: this.roles,
                };
                try {
                    const result = await axios.post('/vue_api/users', data);

                    console.log(result.data);

                    if(result.data.result == 'error') {
                        if(result.data.messages.password)
                            this.passwordMessages = result.data.messages.password;
                        if(result.data.messages.email)
                            this.mainMessages = result.data.messages.email;
                    }
                    else if(result.data.result == 'ok') {
                        this.$router.push({ name: 'users.edit', params: { id: result.data.user } })
                    }
                }
                catch(error) {
                    console.log(error);
                }

                this.editDisabled = false;
            },
            closePasswordMessage(index) {
                this.passwordMessages.splice(index, 1);
            },
            closeMainMessage(index) {
                this.mainMessages.splice(index, 1);
            },
        },
        mounted() {
            this.getRoles();
            
        },
        watch: {
            user: {
                immediate: true,
                handler(newVal, oldVal) {
                    this.getRoles();
                }
            }
        },
        props: ['user'],
    }
</script>

<style>
    .notify-padding {
        padding: 20px 10px 0px;
    }
</style>