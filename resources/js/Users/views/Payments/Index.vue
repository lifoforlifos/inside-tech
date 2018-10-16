<template>
    <div class="container">
        <h1>Please give us your payment details:</h1>

        <form action="/api/checkout" method="POST" id="payment-form" @submit.prevent="pay()">
            <div class="form-group">
                <label for="name_on_card">Name on Card</label>
                <input type="text" class="form-control" data-stripe="name" v-model="name_on_card">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" data-stripe="address_line1" v-model="address">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" data-stripe="address_city" v-model="address_city">
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <p class="form-control" data-stripe="amount" v-model="amount">{{ amount }}</p>
            </div>

            <div class="form-group">
                <label for="postalcode">Postal Code</label>
                <input type="text" class="form-control" data-stripe="address_zip" v-model="postalcode">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <small class="text-danger ml-1">Only 2 letters, ex: MA</small>
                <input type="text" class="form-control" data-stripe="address_country" v-model="country">
            </div>

            <div class="form-group">
                <label for="card-element">Credit Card</label>
                <card class='stripe-card'
                    :class='{ complete }'
                    stripe='pk_test_KlhOyYyrUZgiAtOGw89Ktmo1'
                    :options='stripeOptions'
                    @change='change($event)'
                />
            </div>

            <!-- CSRF Field -->
            <input type="hidden" name="_token" :value="csrf">

            <button type="submit" class="btn btn-success">Submit Payment</button>
        </form>
    </div>
</template>

<script>
    import Auth from '../../Helpers/auth'
    import Flash from '../../Helpers/flash'
    import {get, post} from '../../Helpers/api'

    import { Card, createToken } from 'vue-stripe-elements-plus'

    export default {
        components: {
            Card
        },
        data() {
            return {
                authState: Auth.state,
                complete: false,
                stripeOptions: {
                    style: {
                        base: {
                            color: '#32325d',
                            lineHeight: '18px',
                            fontFamily: '"Raleway", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    },
                    hidePostalCode: true,
                },
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                name_on_card: '',
                address: '',
                address_city: '',
                amount: '',
                postalcode: '',
                country: '',
            }
        },
        computed: {
            stripeData: function() {
                return {
                    name: this.name_on_card,
                    address_line1: this.address,
                    address_city: this.address_city,
                    address_zip: this.postalcode,
                    address_country: this.country,
                    total: this.amount
                }
            }
        },
        created() {
            get('/api/total')
                .then((res) => {
                    this.amount = res.data.total
                })
        },
        methods: {
            pay () {
                createToken(this.stripeData).then(result => {
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    var amountTotal = document.createElement('input');
                    amountTotal.setAttribute('type', 'hidden');
                    amountTotal.setAttribute('name', 'total');
                    amountTotal.setAttribute('value', this.amount);
                    form.appendChild(amountTotal);

                    var userId = document.createElement('input');
                    userId.setAttribute('type', 'hidden');
                    userId.setAttribute('name', 'user_id');
                    userId.setAttribute('value', this.authState.user_id);
                    form.appendChild(userId);

                    // Submit the form
                    form.submit();

                    Flash.setSuccess('Payment executed successfuly!')
                })
            },
            change(event) {
                if (event.error) {
                    Flash.setError(event.error.message)
                }
            },

        }
    }
</script>

<style media="screen">
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid #ccd0d2;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
