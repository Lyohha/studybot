<template>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Inline form</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form role="form" class="form-inline" method="POST" @submit.prevent="login" >
                        <div class="form-group">
                            <input type="email" v-model="email" placeholder="Enter email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" v-model="password" placeholder="Password" class="form-control">
                        </div>
                        <!-- <div class="form-check abc-checkbox form-check-inline m-l-md">
                            <input class="form-check-input" type="checkbox"  value="option1">
                            <label class="form-check-label"> Remember me </label>
                        </div> -->
                        <button class="btn btn-white" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            async login() {
                console.log('login');

                let data = {
                    email: this.email,
                    password: this.password,
                };

                try {
                    const result = await axios.post('/api/vue/login', data);

                    console.log(result.data);

                    // if(result.data.result == 'error') {
                    //     console.log(result.data.messages)
                    // }
                    // else if(result.data.result == 'ok') {
                    //     this.$router.push({ name: 'roles.edit', params: { id: result.data.user } })
                    // }
                }
                catch(error) {
                    console.log(error);
                }

            },
        },
    }
</script>