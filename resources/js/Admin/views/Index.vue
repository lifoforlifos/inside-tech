<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3" v-for="item in items">
                <ul class="list-group">
                    <li class="list-group-item"><b>Reference:</b> {{ item.reference }}</li>
                    <li class="list-group-item"><b>Name:</b> {{ item.name }}</li>
                    <li class="list-group-item"><b>Category:</b> {{ item.category }}</li>
                    <li class="list-group-item"><b>Price:</b> {{ item.price }}</li>
                    <li class="list-group-item"><b>Discount:</b> {{ item.discount }}</li>
                    <li class="list-group-item"><b>Stock:</b> {{ item.stock }}</li>
                    <li class="list-group-item">
                        <router-link :to="`/admin/items/${item.id}`" class="btn btn-primary">Show details</router-link>
                    </li>
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
                items: []
            }
        },
        created() {
            get('/api/items')
                .then((res) => {
                    this.items = res.data.items
                })
        }
    }
</script>
