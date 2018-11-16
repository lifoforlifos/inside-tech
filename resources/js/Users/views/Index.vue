<template>
    <div>
        <!-- Slider -->
    	<div class="main_slider" style="background-image:url(images/1.png)">
    		<div class="container fill_height">
    			<div class="row align-items-center fill_height">
    				<div class="col">
    					<div class="main_slider_content">
    						<h1 class="text-white">Inside Technologie</h1>
    						<h6 class="text-white">Société de sécurité privée située à Casablanca, créée en 2015, s’est donnée pour mission d’assurer la sécurité des personnes et leurs biens.</h6>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- Company -->
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>Our Company</h2>
                </div>
            </div>
        </div>
    	<div class="newsletter">
    		<div class="container">
                <div class="display-1 text-center p-5">
    				<h4>INSIDE TECHNOLOGIE is specialized in the protection of goods and people, our mission is to meet your expectations and provide solutions tailored to all your security needs.</h4>

    				<h4>We ensure in all circumstances the supervision of your property in a continuous or temporary way. In addition, we set up, day and night, logistical and human resources to ensure a service adapted to your structure.</h4>

                    <h4>Thus, we try to differentiate ourselves from our competitors by providing you services of a quality-price ratio rare in our activity.</h4>
    			</div>
    		</div>
    	</div>

    	<!-- Banner -->
    	<div class="banner">
    		<div class="container">
                <div class="row">
    				<div class="col text-center">
    					<div class="section_title new_arrivals_title">
    						<h2>Our Services</h2>
    					</div>
    				</div>
    			</div>
                <br><br>
    			<div class="row">
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/8.png)">
    						<div class="banner_category">
    							<router-link to="/items/category/rfid">RFID</router-link>
    						</div>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/1.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/vente">Point of sale</router-link>
    						</div>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/2.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/temps">Time manage</router-link>
    						</div>
    					</div>
    				</div>
                    <div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/3.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/video">Surveillance</router-link>
    						</div>
    					</div>
    				</div>
    			</div>
                <br><br>
                <div class="row">
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/4.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/alarme">Alarm system</router-link>
    						</div>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/5.png)">
    						<div class="banner_category">
    							<a href="/items/category/incendie">Fire detection</a>
    						</div>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/6.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/acces">Access control</router-link>
    						</div>
    					</div>
    				</div>
                    <div class="col-md-3">
    					<div class="banner_item align-items-center" style="background-image:url(images/7.png)">
    						<div class="banner_category">
                                <router-link to="/items/category/solaire">Solar system</router-link>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

    	<!-- Benefit -->
    	<div class="benefit">
    		<div class="container">
                <div class="row">
    				<div class="col text-center">
    					<div class="section_title new_arrivals_title">
    						<h2>We promise</h2>
    					</div>
    				</div>
    			</div>
                <br><br>
    			<div class="row benefit_row">
    				<div class="col-lg-3 benefit_col">
    					<div class="benefit_item d-flex flex-row align-items-center">
    						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
    						<div class="benefit_content">
    							<h6>free installation</h6>
    							<p>No charges for installtion</p>
    						</div>
    					</div>
    				</div>
    				<div class="col-lg-3 benefit_col">
    					<div class="benefit_item d-flex flex-row align-items-center">
    						<div class="benefit_icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
    						<div class="benefit_content">
    							<h6>After sales services</h6>
    							<p>Providing all the help and informations</p>
    						</div>
    					</div>
    				</div>
    				<div class="col-lg-3 benefit_col">
    					<div class="benefit_item d-flex flex-row align-items-center">
    						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
    						<div class="benefit_content">
    							<h6>2 years warranty</h6>
    							<p>Providing best warranty</p>
    						</div>
    					</div>
    				</div>
    				<div class="col-lg-3 benefit_col">
    					<div class="benefit_item d-flex flex-row align-items-center">
    						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
    						<div class="benefit_content">
    							<h6>opening all week</h6>
    							<p>8AM - 6PM</p>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import Auth from '../Helpers/auth'
    import {get, post} from '../Helpers/api'
    import Flash from '../Helpers/flash'

    export default {
        data() {
            return {
                authState: Auth.state,
                slides: []
            }
        },
    }
</script>
