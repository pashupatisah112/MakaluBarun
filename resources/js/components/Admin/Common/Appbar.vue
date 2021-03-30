<template>
<div>
    <v-app-bar color="deep-purple accent-4" dense dark app>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>

        <v-toolbar-title>Admin Dashboard</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-menu left bottom offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn text v-bind="attrs" v-on="on" class="text-capitalize mx-5" dark>
                    {{admin.username}}
                    <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
            </template>

            <v-list>
                <v-list-item link @click="passwordChangeDialog=true">
                    <v-list-item-subtitle>
                        <v-icon>mdi-shield-lock</v-icon>Change Password
                    </v-list-item-subtitle>
                </v-list-item>
                <v-list-item link @click="logout">
                    <v-list-item-subtitle>
                        <v-icon>mdi-logout</v-icon>Logout
                    </v-list-item-subtitle>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-app-bar>

    <!-- password change dialog -->
    <v-dialog v-model="passwordChangeDialog" max-width="400" persistent>
        <v-card class="mx-auto">
            <v-card-title>
                Reset your password
            </v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-text-field label="Enter old password" :error-messages="passwordError" outlined dense v-model="oldPassword" :type="show1? 'text': 'password'" :append-icon="show1? 'mdi-eye': 'mdi-eye-off'" @click:append="show1 = !show1" :rules="[rules.required]" prepend-inner-icon="mdi-lock"></v-text-field>
                    <v-text-field label="Enter new password" outlined dense v-model="newPassword" :type="show2? 'text': 'password'" :append-icon="show2? 'mdi-eye': 'mdi-eye-off'" @click:append="show2 = !show2" :rules="[rules.required,rules.length,rules.case,rules.number]" prepend-inner-icon="mdi-lock"></v-text-field>
                    <v-text-field label="Re-enter new Password" outlined single-line dense type="password" v-model="confirmPassword" :rules="[rules.required,rules.confirm]" prepend-inner-icon="mdi-lock"></v-text-field>
                    <v-row>
                        <v-btn @click="passwordChangeDialog=false" class="text-capitalize">Cancel</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn @click="changePassword" class="text-capitalize">Confirm</v-btn>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
    <!-- end password dialog -->

    <v-snackbar v-model="dataUpdateAlert" :color="alertColor" :timeout="timeout">
        <v-icon color="white" style="margin-right:10px">mdi-checkbox-marked-circle</v-icon>
        {{ dataUpdateMsg }}
        <v-btn color="white" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
</div>
</template>

<script>
export default {
    data() {
        return {
            admin: '',

            //password change dialog
            passwordChangeDialog: false,
            valid: true,
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
            show1: false,
            show2: false,
            rules: {
                required: value => !!value || "Required.",
                length: v => v.length >= 8 || "Min 8 characters",
                case: v => /(?=.*[A-Z])/.test(v) || 'Must have one uppercase',
                number: v => /(?=.*\d)/.test(v) || 'Must have one number',
                confirm: v => this.newPassword == this.confirmPassword || "Password must match",
                valid_email: v => /.+@.+\..+/.test(v) || "E-mail must be valid",
            },
            passwordError: '',

            //snackbar
            dataUpdateAlert: false,
            alertColor: 'success',
            timeout: 3000,
            dataUpdateMsg: '',
        }
    },
    created() {
        this.getAdmin()
    },
    methods: {
        getAdmin() {
            axios.get('api/getAdmin')
                .then(res => {
                    this.admin = res.data
                })
                .catch(err => console.log(err.response))
        },
        logout() {
            localStorage.removeItem('token')
            this.$router.push({
                name: 'AdminLogin'
            })
        },
        changePassword() {
            if (this.$refs.form.validate()) {
                axios.post('api/changePassword', {
                    'old': this.oldPassword,
                    'new': this.newPassword,
                    'user': this.admin.username
                }).then(res => {
                    console.log(res.data)
                    if (res.data == true) {
                        this.passwordChangeDialog = false
                        this.dataUpdateMsg = 'Password successfully changed.'
                        this.dataUpdateAlert = true
                        
                    } else {
                        this.passwordError = 'You old password did not match. Try again.'
                    }
                }).catch(err => console.log(err.response))
            }

        }
    }
}
</script>
