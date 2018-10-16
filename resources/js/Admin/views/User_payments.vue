<template>
    <div class="container">
        <router-link to="/admin/payments" class="btn btn-primary">Back</router-link>
        <br><br>

        <div class="row">
            <div class="col-md-3" v-for="payment in payments">
                <ul class="list-group">
                    <li class="list-group-item"><b>User_id:</b> {{ payment.user_id }}</li>
                    <li class="list-group-item"><b>Amount:</b> {{ payment.amount }}</li>
                </ul>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from '../Helpers/auth'
    import {get} from '../Helpers/api'
    import Flash from '../Helpers/flash'

    export default {
        data() {
            return {
                authState: Auth.state,
                payments: []
            }
        },
        created() {
            get(`/api/admin/${this.$route.params.id}/payments`)
                .then((res) => {
                    this.payments = res.data.payments
                })
        }
    }
</script>
