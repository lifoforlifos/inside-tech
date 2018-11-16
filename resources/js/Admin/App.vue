<template>
    <div class="super_container">
        <!-- Header -->
    	<header class="header trans_300">
    		<!-- Top Navigation -->
    		<div class="top_nav">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    					</div>
    					<div class="col-md-6 text-right">
    						<div class="top_nav_right">
    							<ul class="top_nav_menu">
    								<li class="account" v-if="guest">
    									<a href="#">
    										Sign In
    										<i class="fa fa-angle-down"></i>
    									</a>
    									<ul class="account_selection">
                                            <li><router-link to="/admin"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</router-link></li>
    									</ul>
    								</li>
                                    <li class="account" v-if="admin">
    									<a href="#">
    										logout
    										<i class="fa fa-angle-down"></i>
    									</a>
    									<ul class="account_selection">
                                            <li><a @click.stop="logout" class="text-dark" style="cursor: pointer;"><i class="fa fa-sign-in" aria-hidden="true"></i>Logout</a></li>
    									</ul>
    								</li>
    							</ul>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>

    		<!-- Main Navigation -->
    		<div class="main_nav_container">
    			<div class="container">
    				<div class="row">
    					<div class="col-lg-12 text-right">
    						<div class="logo_container">
                                <router-link to="/admin">
                                    <img src="/images/logo.png" width="80px" height="80px;" class="responsive mr-2">
                                    Inside Technologie
                                </router-link>
    						</div>
    						<nav class="navbar">
    							<ul class="navbar_menu" v-if="admin">
    								<li><router-link to="/admin/dashboard">Dashboard</router-link></li>
    								<li><router-link to="/admin/items">Items</router-link></li>
    								<li><router-link to="/admin/create">Add Item</router-link></li>
    								<li><router-link to="/admin/payments">Payments</router-link></li>
    							</ul>
    							<div class="hamburger_container">
    								<i class="fa fa-bars" aria-hidden="true"></i>
    							</div>
    						</nav>
    					</div>
    				</div>
    			</div>
    		</div>
    	</header>

        <!-- Flash messages -->
        <div class="flash flash__error" style="position: fixed; right: 10px; top: 50px; z-index: 10;" v-if="flash.error">
			{{flash.error}}
		</div>
		<div class="flash flash__success" style="position: fixed; right: 10px; top: 50px; z-index: 10;" v-if="flash.success">
			{{flash.success}}
		</div>

        <!-- Content View -->
        <div style="margin-top: 180px; margin-bottom: 50px;">
            <router-view :key="$route.fullPath"></router-view>
        </div>

        <!-- Footer -->
    	<footer class="footer" style="border-top: 1px solid lightgrey; padding: 0px;">
    		<div class="container">
    			<div class="row">
    				<div class="col-lg-6">
    					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
    						<ul class="footer_nav">
                                <li><router-link to="/admin/dashboard">Dashboard</router-link></li>
                                <li><router-link to="/admin/items">Items</router-link></li>
                                <li><router-link to="/admin/create">Add Item</router-link></li>
                                <li><router-link to="/admin/payments">Payments</router-link></li>
    						</ul>
    					</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
    						<ul>
    							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
    							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
    							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
    							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
    							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
    						</ul>
    					</div>
    				</div>
    			</div>
                <hr>
    			<div class="row">
    				<div class="col-lg-6">
    					<div class="footer_nav_container">
    						<div class="cr">With <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Abdelmoughit FITAH</a></div>
    					</div>
    				</div>
                    <div class="col-lg-6">
    					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
    						<ul>
    							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
    							<li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
    						</ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</footer>
    </div>
</template>

<script>
    import Auth from './Helpers/auth'
    import Flash from './Helpers/flash'
    import {post, interceptors, get} from './Helpers/api'

    export default {
        created() {
            // global error http handler
			interceptors((err) => {
				if(err.response.status === 401) {
					Auth.remove()
					this.$router.push('/admin/login')
				}

				if(err.response.status === 500) {
					Flash.setError(err.response.statusText)
				}

				if(err.response.status === 404) {
					this.$router.push('/')
                    Flash.setError('Page not found!')
				}
			})
			Auth.initialize()
		},
		data() {
			return {
				authState: Auth.state,
				flash: Flash.state,
			}
		},
        computed: {
			admin() {
				if(this.authState.api_token) {
					return true
				}
				return false
			},
			guest() {
				return !this.admin
			},
		},
		methods: {
			logout() {
				post('/api/admin/logout')
				    .then((res) => {
				        if(res.data.logged_out) {
				            // remove token
				            Auth.remove()
				            Flash.setSuccess('You have successfully logged out.')
				            this.$router.push('/')
				        }
				    })
			}
		}
    }
</script>
