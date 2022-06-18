import Vue from 'vue'
import * as Router from 'vue-router';


import Hotel from './page/Hotel.vue'
import Habitaciones from './page/Habitacion.vue'
import Home from './layout/Home.vue'

Vue.use(Router)

const router = new Router({
	mode:'history',
	routes:[
		{
			path:'',name:'home',component:Home
		},
		{
			path:'/hotel',name:'hotel',component:Hotel
		},
		{
			path:'/habitaciones',name:'habitaciones',component:Habitaciones
		},
	]
});

export default router;