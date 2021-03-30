<template>
<div>
    <v-app>
        <v-container>
            <v-row justify="center">
                <v-col cols="6" style="margin-top:15%" align="center">
                    <v-card rounded width="400">
                        <div style="width:100%;background-color:green" class="text-center pa-2 white--text mb-5">Welcome Admin</div>
                        <v-form v-model="valid" ref="form">
                            <v-text-field v-model="username" :error-messages="loginError" outlined label="Enter email" dense prepend-inner-icon="mdi-shield-account" class="mx-5" :rules="[validRules.required]"></v-text-field>
                            <v-text-field v-model="password" type="password" dense outlined label="Password" prepend-inner-icon="mdi-shield-lock" class="mx-5" :rules="[validRules.required]"></v-text-field>
                            <v-btn class="mb-5 mx-auto" @click="login">Login</v-btn>
                        </v-form>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</div>
</template>

<script>
export default {
    data() {
        return {
            valid:true,
            username: '',
            password: '',
            validRules: {
                required: value => !!value || "Required.",
            },
            auth: [],
            loginError: ''
        }
    },
    methods: {
        login() {
            if(this.$refs.form.validate()){
                axios.post('api/adminLogin', {
                'username': this.username,
                'password': this.password
            }).then(res => {
                localStorage.setItem("token", res.data.token)
                this.auth = res.data.admin
                this.$router.push({
                    name: 'AdminDashboard',
                })
            }).catch(err => {
                this.loginError = err.response.data.status
            })
            }
            
        }
    }
}
</script>
