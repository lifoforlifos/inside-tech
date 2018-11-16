import Vue from 'vue'
import VueRouter from 'vue-router'

import AdminLogin from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import AdminIndex from '../views/Index.vue'
import AdminShow from '../views/Show.vue'
import AdminCreate from '../views/Create.vue'
import AdminEdit from '../views/Edit.vue'
import AdminPayments from '../views/Payments.vue'
import AdminUserPayment from '../views/User_payments'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/admin', component: AdminLogin },
		{ path: '/admin/dashboard', component: Dashboard},
		{ path: '/admin/items', component: AdminIndex },
		{ path: '/admin/items/:id', component: AdminShow },
		{ path: '/admin/create', component: AdminCreate },
		{ path: '/admin/items/:id/edit', component: AdminEdit },
		{ path: '/admin/payments', component: AdminPayments },
		{ path: '/admin/user/:id/payments', component: AdminUserPayment },
	]
})

export default router
