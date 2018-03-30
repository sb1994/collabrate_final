import Vue from 'vue';
import VueRouter from 'vue-router';


import Index from '../views/Index.vue'
import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'

import ProfilePage from '../views/Profile/Profile.vue'
import ProfileEdit from '../views/Profile/ProfileEdit.vue'

import CreateProject from '../views/Project/ProjectAdd.vue'
import EditProject from '../views/Project/ProjectEdit.vue'
import ShowProject from '../views/Project/ProjectShow.vue'
import Projects from '../views/Project/Projects.vue'
import SearchProjects from '../views/Project/SearchProjects.vue'
Vue.use(VueRouter);

const router = new VueRouter({
	//mode: 'history',
	base: __dirname,
	routes: [
    { path: 'project_pro/',name:'index', component: Index },
		{
			path: '/profile',
			name:'profile',
			component: ProfilePage,
			meta:{
				forAuth:true
			},
			children:[
				{
						path: '/project/create',
						name:'project_create',
						component: CreateProject,
						//meta fields used to decide who can access what page
					},
				{
						path: '/projects',
						name:'projects_view',
						component: Projects,
						//meta fields used to decide who can access what page
						meta:{
							forAuth:true
						}
					},
					{
							path: '/projects/edit/:id',
							name:'project_edit',
							component: EditProject,
							//meta fields used to decide who can access what page
							meta:{
								forAuth:true
							}
						},
					{
							path: '/projects/show/:id',
							name:'project_show',
							component: ShowProject,
							//meta fields used to decide who can access what page
							meta:{
								forAuth:true
							}
						},
			]
		},
		{
			path: 'profile/edit',
			name:'profile_edit',
			component: ProfileEdit,
			meta:{
				forAuth:true
			}
		},
		{
			path: '/register',
			name:'register',
			component: Register,
			//meta fields used to decide who can access what page
			meta:{
				forVisitors:true
			}
		},
		{
				path: '/login',
				name:'login',
				component: Login,
				//meta fields used to decide who can access what page
				meta:{
					forVisitors:true
				}
		 	},
			{
				path:'/search-projects',
				name:'search-projects',
				component: SearchProjects,
				//meta fields used to decide who can access what page
				meta:{
					forVisitors:true
				}
			}

		// { path: '/not-found', component: NotFound },
		// { path: '*', component: NotFound }
	]
})

export default router
