<template>
    <div v-if="user.rules.edit_roles" class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Roles</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'main'}">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    All roles
                </li>
            </ol>
        </div>
    </div>
    <div v-if="user.rules.edit_roles" class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">

					<table class="footable table table-stripped " data-page-size="15">
						<thead>
							<tr>

								<th>ID</th>
								<th>Name</th>
								<th>Date added</th>
								<th>Date modified</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
                            <tr v-for="item in roles" :key="item.id">
                                <td>
                                    {{ item.id }}
                                </td>
                                <td>
                                    {{ item.name }}
                                </td>
                                <td>
                                    {{ item.created_at }}
                                </td>
                                <td>
                                    {{ item.updated_at }}
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <router-link :to="{ name: 'roles.edit', params: { id: item.id } }" class="btn-success btn btn-xs">Edit</router-link>
                                        <button @click="remove(item.id)" class="btn btn-xs btn-danger">Remove</button>
                                    </div>
                                </td>
                            </tr>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="9">
									<ul class="pagination float-right">
										<li v-if="currentPage > 1" class="footable-page-arrow">
                                            <router-link :to="{name: 'roles.list', }">«</router-link>
										</li>
										<li v-if="currentPage > 1" class="footable-page-arrow">
                                            <router-link :to="{ name: 'roles.list', query: { page: currentPage - 1 } }">‹</router-link>
										</li>
                                        <li v-if="currentPage > 2" class="footable-page">
                                            <router-link :to="{ name: 'roles.list', query: { page: currentPage - 2 } }">{{ currentPage - 2 }}</router-link>
										</li>
                                        <li v-if="currentPage > 1" class="footable-page">
                                            <router-link :to="{ name: 'roles.list', query: { page: currentPage - 1 } }">{{ currentPage - 1 }}</router-link>
										</li>
                                        <li v-if="countPage > 1" class="footable-page active">
                                            <router-link :to="{ name: 'roles.list', query: { page: currentPage } }">{{ currentPage }}</router-link>
										</li>
                                         <li v-if="currentPage < countPage" class="footable-page">
                                            <router-link :to="{ name: 'roles.list', query: { page: +currentPage + 1 } }">{{ +currentPage + 1 }}</router-link>
										</li>
                                        <li v-if="currentPage + 1 < countPage" class="footable-page">
                                            <router-link :to="{ name: 'roles.list', query: { page: +currentPage + 2 } }">{{ +currentPage + 2 }}</router-link>
										</li>

										<li v-if="currentPage < countPage"  class="footable-page-arrow">
                                            <router-link :to="{ name: 'roles.list', query: { page: currentPage + 1 } }">›</router-link>
										</li>
										<li v-if="currentPage < countPage" class="footable-page-arrow">
                                            <router-link :to="{ name: 'roles.list', query: { page: countPage } }">»</router-link>
										</li>
									</ul>
								</td>
							</tr>
						</tfoot>
					</table>

				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                roles: [],
                currentPage: 0,
                countPage: 0,
            };
        },
        methods: {
            async fetchRoles() {
                if(this.user.rules.edit_roles) {
                    try {
                        const url = '/vue_api/roles?page=' + this.currentPage;
                        const result = await axios.get(url);

                        console.log(result.data);

                        this.roles = result.data.data;
                        this.countPage = result.data.last_page;
                    }
                    catch(error) {
                        console.log(error);
                    }
                }
            },
            async remove(id) {
                if(this.user.rules.edit_roles) {
                    if(!confirm('Realy want remove?'))
                        return;
                    try {
                        const url = '/vue_api/roles/' + id;
                        const result = await axios.delete(url);
                        console.log(result);
                    }
                    catch(error) {
                        console.log(error);
                    }
                    this.fetchRoles();
                }
            }
        },
        mounted() {
            this.currentPage = this.$route.query.page || 1;
            this.fetchRoles();
        },
        watch: {
            user: {
                immediate: true,
                handler(newVal, oldVal) {
                    this.fetchRoles();
                }
            }
        },
        props: ['user'],
    }
</script>