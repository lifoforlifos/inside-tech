<template>
    <div class="container">
        <form @submit.prevent="register()">
            <h1 class="form-title">Create an Account</h1>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" v-model="form.name" placeholder="Enter name">
                <small class="text-danger" v-if="error.name">{{ error.name[0] }}</small>
            </div>
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

            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</template>

<script>
    import Flash from '../../Helpers/flash'

    export default {
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                error: {}
            }
        },
        methods: {
            register() {
                this.error = {}
                axios.post('/api/register', this.form)
                    .then((res) => {
                        Flash.setSuccess('You have successfully created an account! You need to login now!')
                        this.$router.push('/login')
                    }).catch((err) => {
                        if (err.response.status === 422) {
                            this.error = err.response.data.errors
                        }
                    })
            }
        }
    }
</script>
