<template>
    <div class="container">
        <div class="">
            <ul class="list-group">
                <li class="list-group-item">
                    <label><b>Reference:</b> </label>
                    <div class="input-group mb-3">
                        <input type="text" v-model="form.reference" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Name:</b> </label>
                    <div class="input-group mb-3">
                        <input type="text" v-model="form.name" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Description:</b> </label>
                    <div class="input-group mb-3">
                        <textarea v-model="form.description" class="form-control" rows="5" cols="50"></textarea>
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Category:</b> </label> <br>
                    <div class="input-group mb-3">
                        <select class="custom-select" v-model="f_category">
                            <option selected>Choose...</option>
                            <option v-for="category in form.category">
                                {{ category }}
                            </option>
                        </select>
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Price:</b> </label>
                    <div class="input-group mb-3">
                        <input type="number" v-model="form.price" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Discount:</b> </label>
                    <div class="input-group mb-3">
                        <input type="number" v-model="form.discount" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <label><b>Stock:</b> </label>
                    <div class="input-group mb-3">
                        <input type="number" v-model="form.stock" class="form-control">
                    </div>
                </li>
                <li class="list-group-item">
                    <button type="button" class="btn btn-success" @click="saveItem()">Save</button>
                    <a @click="$router.go(-1)" class="btn btn-primary text-white" role="button">Back</a>
                </li>
            </ul>
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
                form: {
                    reference: '',
                    name: '',
                    description: '',
                    category: '',
                    price: '',
                    discount: '',
                    stock: ''
                },
                f_category: ''
            }
        },
        created() {
            get(`/api/items/create`)
                .then((res) => {
                    this.form = res.data.form
                })
        },
        methods: {
            saveItem() {
                this.form.category = this.f_category
                post(`/api/items`, this.form)
                    .then((res) => {
                        if (res.data.created) {
                            Flash.setSuccess('Item created!')
                            this.$router.push('/items')
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
