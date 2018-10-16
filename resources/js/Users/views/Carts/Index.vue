<template>
    <div class="container">
        <h1 class="text-center">My Cart</h1>
        <br><br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cart in carts">
                    <td>{{ cart.item_name }}</td>
                    <td>{{ cart.price }} MAD</td>
                    <td>
                        <div class="input-group">
                            <span class="btn btn-danger mr-2">
                            	<i class="fa fa-minus" aria-hidden="true" @click="subQty(cart.quantity, cart.id)"></i>
                            </span>
                            <input type="text" readonly v-model="cart.quantity" style="width: 50px;">
                            <span class="btn btn-primary ml-2">
                          		<i class="fa fa-plus" aria-hidden="true" @click="addQty(cart.quantity, cart.id)"></i>
                            </span>
                        </div>
                    </td>
                    <td>{{ cart.sub_total }} MAD</td>
                    <td><button type="button" @click="removeCart(cart.id)" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total: </strong>{{ total }} MAD</td>
                    <td><router-link to="/payments" class="btn btn-primary">Proceed to pay</router-link></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Auth from '../../Helpers/auth'
    import Flash from '../../Helpers/flash'
    import {get, post, del} from '../../Helpers/api'

    export default {
        data() {
            return {
                authState: Auth.state,
                carts: [],
                form: {
                    quantity: '',
                },
                id: '',
                total: '',
                quantity: ''
            }
        },
        created() {
            get('/api/carts')
                .then((res) => {
                    this.carts = res.data.carts
                }).catch((err) => {
                    if (err.response.status === 422) {
                        Flash.setError(err.response.data.error)
                        this.$router.push('/items')
                    }
                })
            get('/api/total')
                .then((res) => {
                    this.total = res.data.total
                })
        },
        updated() {
            get('/api/total')
                .then((res) => {
                    this.total = res.data.total
                })
        },
        methods: {
            addQty(qty, id) {
                this.form.quantity = qty + 1;
                this.id = id;
                post(`/api/carts/${this.id}?_method=PUT`, this.form)
                    .then((res) => {
                        if (res.data.edited) {
                            Flash.setSuccess('Quantity updated!')
                            this.$router.push('/carts')
                            this.carts = res.data.carts
                        }
                    }).catch((err) => {
                        if (err.response.status === 422) {
                            Flash.setError(err.response.data.error)
                        }
                    })
            },
            subQty(qty, id) {
                this.form.quantity = qty - 1;
                this.id = id;
                post(`/api/carts/${this.id}?_method=PUT`, this.form)
                    .then((res) => {
                        if (res.data.edited) {
                            Flash.setSuccess('Quantity updated!')
                            this.$router.push('/carts')
                            this.carts = res.data.carts
                        }
                    }).catch((err) => {
                        if (err.response.status === 422) {
                            Flash.setError(err.response.data.error)
                        }
                    })
            },
            removeCart(id) {
                this.id = id
                del(`/api/carts/${this.id}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            Flash.setSuccess('Cart removed!')
                            this.$router.push('/carts')
                            this.carts = res.data.carts
                        }
                    })
            }
        }
    }
</script>
