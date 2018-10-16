<template>
    <!-- New Arrivals -->
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Our Products</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items">All</router-link>
							</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/vente">Point de vente</router-link>
							</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/temps">Gestion du temps</router-link>
							</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/video">Vidéo Surveillance</router-link>
							</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/alarme">Système d'alarme</router-link>
							</li>
						</ul>
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group" style="margin-left: 70px;">
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/incendie">Détection Incendie</router-link>
							</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/acces">Contrôle d'accès</router-link>
							</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/solaire">Système Solaire</router-link>
							</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center">
								<router-link to="/items/category/rfid">RFID</router-link>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<br><br>

			<div class="row">
		        <section class="details-card">
		            <div class="container">
		                <div class="row">
		                    <div class="col-md-3" v-for="item in items">
		                        <div class="card-content">
		                            <div class="card-img">
										<img v-if="item.category == 'vente'" src="/images/1.png" />
	                                    <img v-if="item.category == 'temps'" src="/images/2.png" />
	                                    <img v-if="item.category == 'video'" src="/images/3.png" />
	                                    <img v-if="item.category == 'alarme'" src="/images/4.png" />
	                                    <img v-if="item.category == 'incendie'" src="/images/5.png" />
	                                    <img v-if="item.category == 'acces'" src="/images/6.png"/>
	                                    <img v-if="item.category == 'solaire'" src="/images/7.png" />
	                                    <img v-if="item.category == 'rfid'" src="/images/8.png" />
		                                <span class="ml-3"><h4>{{ item.price }} MAD</h4></span>
		                            </div>
		                            <div class="card-desc">
		                                <h3>{{ item.name }}</h3>
		                                <h5>{{ item.category }}</h5>
		                                <p class="text-justify">{{ item.description }}</p>
		                                <router-link :to="`/items/${item.id}`" class="btn-card" style="padding: .60rem 2rem;">Show</router-link>
		                                <button type="submit" class="btn-card" @click="addToCart(item.id)">Add</button>
		                            </div>
		                        </div>
								<br><br>
		                    </div>
		                </div>
		            </div>
		        </section>
		    </div>
		</div>
	</div>
</template>

<script>
    import Auth from '../../Helpers/auth'
    import {get, post} from '../../Helpers/api'
    import Flash from '../../Helpers/flash'

    export default {
        data() {
            return {
                authState: Auth.state,
                form: {
                    quantity: 1,
                    item_id: ''
                },
                items: [],
            }
        },
		created() {
            get(`/api/items/category/${this.$route.params.id}`)
                .then((res) => {
                    this.items = res.data.items
                })
        },
        methods: {
            addToCart(id) {
                this.form.item_id = id
                post(`/api/carts`, this.form)
                    .then((res) => {
                        if (res.data.saved) {
                            Flash.setSuccess('Added to Cart!')
                        }
                    }).catch((err) => {
                        if (err.response.status === 422) {
                            Flash.setError(err.response.data.error)
                        }
                    })
            }
        }
    }
</script>

<style media="screen">
/* card details start  */
@import url('https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:400,400i,700,700i');
section{
    padding: 30px 0;
}
.details-card {
	background: #ecf0f1;
}

.card-content {
	background: #ffffff;
	border: 4px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}

.card-img {
	position: relative;
	overflow: hidden;
	border-radius: 0;
	z-index: 1;
}

.card-img img {
	width: 100%;
	height: 215px;
	display: block;
}

.card-img span {
	position: absolute;
    top: 15%;
    left: 12%;
    background: #1ABC9C;
    padding: 6px;
    color: #fff;
    font-size: 12px;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    transform: translate(-50%,-50%);
}
.card-img span h4{
    font-size: 12px;
    margin:0;
    padding:10px 5px;
    line-height: 0;
}

.card-desc {
	padding: 1.25rem;
}

.card-desc h3 {
	color: #000000;
    font-weight: 600;
    font-size: 1.5em;
    line-height: 1.3em;
    margin-top: 0;
    margin-bottom: 5px;
    padding: 0;
}

.card-desc p {
	color: #747373;
    font-size: 14px;
	font-weight: 400;
	font-size: 1em;
	line-height: 1.5;
	margin: 0px;
	margin-bottom: 20px;
	padding: 0;
	font-family: 'Raleway', sans-serif;
	white-space: nowrap;
    overflow: hidden;
	text-overflow: ellipsis;
}
.btn-card{
	background-color: #1ABC9C;
	color: #fff;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    padding: .50rem 2rem;
    font-size: .81rem;
    -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    -o-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    margin: 0;
    border: 0;
    -webkit-border-radius: .125rem;
    border-radius: .125rem;
    cursor: pointer;
    text-transform: uppercase;
    white-space: normal;
    word-wrap: break-word;
    color: #fff;
}
.btn-card:hover {
    background: orange;
}
a.btn-card {
    text-decoration: none;
    color: #fff;
}
/* End card section */
</style>
