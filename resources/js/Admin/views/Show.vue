<template>
    <div class="container">
        <router-link to="/admin/items" class="btn btn-primary">Back</router-link>
        <br><br>
        
        <ul class="list-group">
            <li class="list-group-item"><b>Reference:</b> {{ item.reference }}</li>
            <li class="list-group-item"><b>Name:</b> {{ item.name }}</li>
            <li class="list-group-item"><b>Description:</b> {{ item.description }}</li>
            <li class="list-group-item"><b>Category:</b> {{ item.category }}</li>
            <li class="list-group-item"><b>Price:</b> {{ item.price }}</li>
            <li class="list-group-item"><b>Discount:</b> {{ item.discount }}</li>
            <li class="list-group-item"><b>Stock:</b> {{ item.stock }}</li>
            <li class="list-group-item">
                <router-link :to="`/admin/items/${item.id}/edit`" class="btn btn-primary">Edit</router-link>
                <button type="button" @click="deleteItem()" class="btn btn-danger">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import Auth from '../Helpers/auth'
    import Flash from '../Helpers/flash'
    import {get, del} from '../Helpers/api'

    export default {
        data() {
            return {
                authState: Auth.state,
                item: {}
            }
        },
        created() {
            get(`/api/items/${this.$route.params.id}`)
                .then((res) => {
                    this.item = res.data.item
                })
        },
        methods: {
            deleteItem() {
                del(`/api/items/${this.$route.params.id}`)
                    .then((res) => {
                        if (res.data.deleted) {
                            Flash.setSuccess('Item removed!')
                            this.$router.push('/admin/items')
                        }
                    })
            }
        }
    }
</script>
