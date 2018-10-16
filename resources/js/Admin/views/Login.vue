<template>
    <div class="container">
        <form @submit.prevent="login()">
            <h1 class="form-title">Admin Login</h1>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" v-model="form.email" placeholder="Enter email">
                <small class="text-danger" v-if="error.email">{{ error.email[0] }}</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" v-model="form.password" placeholder="Enter password">
                <small class="text-danger" v-if="error.password">{{ error.password[0] }}</small>
            </div>

            <button class="btn btn-primary">Login</button>
        </form>
    </div>
</template>

<script>
import Auth from '../Helpers/auth'
import Flash from '../Helpers/flash'
import {post} from '../Helpers/api'

export default {
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: {},
        }
    },
    methods: {
        login() {
            this.error = {}
            post('/api/admin/login', this.form)
                .then((res) => {
                    Auth.set(res.data.api_token, res.data.user_id)
                    Flash.setSuccess('You have successfully logged in!')
                    this.$router.push('/admin/dashboard')
                }).catch((err) => {
                    if (err.response.status === 422) {
                        this.error = err.response.data.errors
                    }

                    Flash.setError("The provided email and password don't match!")
                })
        }
    }
}
</script>
