<template>
<div>
    <v-app>
        <v-container>
            <v-row justify="center">
                <v-col cols="6" style="margin-top:15%" align="center">
                    <v-card rounded width="400">
                        <div style="width:100%;background-color:green" class="text-center pa-2 white--text mb-5">Welcome Admin</div>
                        <v-text-field v-model="username" outlined label="Enter username" dense prepend-inner-icon="mdi-shield-account" class="mx-5"></v-text-field>
                        <v-text-field v-model="password" type="password" dense outlined label="Password" prepend-inner-icon="mdi-shield-lock" class="mx-5"></v-text-field>
                        <v-btn class="mb-5 mx-auto">Login</v-btn>
                        <v-btn text x-small>Forgot Password</v-btn>
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
            username:'',
            password:'',
            validRules: {
                required: value => !!value || "Required.",
            },
        }
    }
}
</script>
