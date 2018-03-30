import Vue from 'vue';
import VueRouter from 'vue-router';


import Index from '../views/Index.vue'
import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'

import ProfilePage from '../views/Profile/Profile.vue'
import ProfileEdit from '../views/Profile/ProfileEdit.vue'

import CreateProject from '../views/Project/ProjectAdd.vue'
import UserProjects from '../views/Project/Projects.vue'

Vue.use(VueRouter);

const router = new VueRouter({
	//mode: 'history',
	base: __dirname,
	routes: [
    { path: 'project_pro/',name:'index', component: Index },
		{
			path: '/profile/',
			name:'profile',
			component: ProfilePage,
			meta:{
				forAuth:true
			},
			children:[
				{
					path: '',
					component:UserProjects
				},
				{
					path: '/edit',
					name:'profile_edit',
					component: ProfileEdit,
					meta:{
						forAuth:true
					}
				}
			]
		},
		// { path: '/recipes/create', component: RecipeForm, meta: { mode: 'create' }},
		// { path: '/recipes/:id/edit', component: RecipeForm, meta: { mode: 'edit' }},
		// { path: '/recipes/:id', component: RecipeShow },
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
				path: '/project/create',
				name:'project_create',
				component: CreateProject,
				//meta fields used to decide who can access what page
				meta:{
					forAuth:true
				}
		 	},
		// { path: '/not-found', component: NotFound },
		// { path: '*', component: NotFound }
	]
})

export default router
