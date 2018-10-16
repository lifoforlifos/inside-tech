<template>
    <div class="container" style="margin-top: 180px;">
        <div class="row mb-3">
            <div class="col-md-4">
                <img class="mt-2" src="/images/1.png" style="width: 100%; height: 250px;;">
            </div>
            <div class="col-md-8 border px-3">
                <h1 class="text-primary">{{ item.name }}</h1>
                <h4>{{ item.reference }}</h4>
                <br><br>

                <h3 class="text-danger">{{ item.price }} MAD</h3>
                <br><br>

                <h5>Stock: {{ item.stock }}</h5>
                <br><br>

                <div class="row">
                    <div class="col-md-2">
                        <h5>Quantity: </h5>
                    </div>
                    <div class="col-md-1">
                        <input type="number" v-model="form.quantity" style="width: 100px;">
                    </div>
                    <div class="col-md-4" style="margin-left: 50px;">
                        <h5>Total price: <span class="text-danger ml-2">{{ total }} MAD</span></h5>
                    </div>
                    <div class="col-md-2" style="margin-left: 100px;">
                        <button type="button" class="btn btn-primary" @click="addToCart(item.id)">Add to cart</button>
                    </div>
                </div>
                <br><br>
            </div>
            <br>
        </div>
        <hr>

        <div class="row mt-5">
            <h3>Product Description</h3>
            <p class="text-justify">{{ item.description }}</p>
        </div>
    </div>
</template>

<script>
    import Auth from '../../Helpers/auth'
    import Flash from '../../Helpers/flash'
    import {get, post} from '../../Helpers/api'

    export default {
        data() {
            return {
                authState: Auth.state,
                item: {},
                form: {
                    quantity: 1,
                    item_id: ''
                },
                total: '',
            }
        },
        created() {
            get(`/api/items/${this.$route.params.id}`)
                .then((res) => {
                    this.item = res.data.item
                }),
            this.total = this.form.quantity * this.item.price
        },
        updated() {
            this.total = this.form.quantity * this.item.price
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
