import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '../views/Index.vue'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'

import ItemIndex from '../views/Items/Index.vue'
import ItemShow from '../views/Items/Show.vue'
import ItemForm from '../views/Items/Form.vue'
import Category from '../views/Items/Category.vue'

import CartIndex from '../views/Carts/Index.vue'

import PaymentIndex from '../views/Payments/Index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
        { path: '/', component: Index },

		{ path: '/items', component: ItemIndex },
		{ path: '/items/create', component: ItemForm, meta: { mode: 'create' }},
		{ path: '/items/:id/edit', component: ItemForm, meta: { mode: 'edit' }},
		{ path: '/items/:id', component: ItemShow },
		{ path: '/items/category/:id', component: Category },

        { path: '/carts', component: CartIndex },

        { path: '/payments', component: PaymentIndex },

		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
	]
})

export default router
