<template>
<div>
   
    <v-container fluid style="color:white" class="prime-back">
        <v-row>
            <!-- organization info -->
            <v-col cols="12" lg="3" md="6">
                <v-card flat dark color="transparent">
                    <v-card-title class="sec-text">MAKALU ARUN VALLEY</v-card-title>

                    <v-card-subtitle>
                        An Organization that believes in hope of better mankind and services.
                    </v-card-subtitle>
                    <v-card-actions>
                        <v-btn fab small href="https://www.facebook.com/Makalu-Arun-Valley-Social-Welfare-100163585519928" target="_blank">
                            <v-icon>mdi-facebook</v-icon>
                        </v-btn>
                        <v-btn fab small target="_blank" href="https://twitter.com/MakaluW">
                            <v-icon>mdi-twitter</v-icon>
                        </v-btn>
                        <v-btn fab small target="_blank" href="https://www.instagram.com/_makalusocialwelfare/">
                            <v-icon>mdi-instagram</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>

            </v-col>
            <!-- end organization info -->

            <!-- quick links -->
            <v-col cols="12" lg="2" md="6">
                <v-card flat dark color="transparent">
                    <v-card-title>
                        Quick Links
                    </v-card-title>
                    <v-btn text small class="my-1" to="/home">
                        Home
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1" to="/about-us">
                        About Us
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1" to="/projects">
                        Projects
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1" to="/blogs">
                        Stories
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1" to="contact-us">
                        Contact
                    </v-btn>
                    <v-divider></v-divider>
                </v-card>

            </v-col>
            <!-- end quick links -->

            <!-- associated company -->
            <v-col cols="12" lg="3" md="6">
                <v-card flat dark color="transparent">
                    <v-card-title>
                        Our Association
                    </v-card-title>
                    <v-row justify="center">
                        <v-col>
                            <v-img src="../images/partner.png" max-width="150" @click="goToAlpine" class="mx-5 assoc"></v-img>
                            <p class="ml-10">Family Alpine Trek</p>
                        </v-col>
                    </v-row>

                </v-card>

            </v-col>
            <!-- end associated company -->

            <!-- newsletter -->
            <v-col cols="12" lg="4" md="6">
                <v-card flat dark color="transparent">
                    <v-card-title>Newletters</v-card-title>
                    <v-card-subtitle>Send us your email to get news about events and campaign.</v-card-subtitle>
                </v-card>
                <v-form v-model="valid" ref="form">
                    <v-text-field v-model="email" background-color="white" filled dense placeholder="Enter your email" rounded :rules="[validRules.required,validRules.email]">
                        <template slot="append">
                            <v-btn rounded dark color="sec" style="margin-top:-7px;margin-right:-21px" @click="subscribe">Send</v-btn>
                        </template>
                    </v-text-field>
                </v-form>
            </v-col>
            <!-- end newsletter -->
        </v-row>
        <v-row justify="center">
            <p class="body-2 text-center white--text">Copyright <v-icon small color="white">mdi-copyright</v-icon> 2021 Makalu Arun Valley Social Welfare.<br> Developed by <span style="color:blue;cursor:pointer" class="font-weight-bold" @click="toFiftech">Fiftech Zone.</span></p>
        </v-row>
        <!-- snackbar -->
        <v-snackbar v-model="snackbar" timeout="3000">
            Your have subscribed to our newsletter. Thank you for supporting us.
            <template v-slot:action="{ attrs }">
                <v-btn color="prime" text v-bind="attrs" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>
        <!-- end snackbar -->
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            valid: true,
            email: '',
            validRules: {
                required: value => !!value || "Required.",
                email: v => /.+@.+\..+/.test(v) || "E-mail must be valid",
            },
            snackbar: false
        }
    },
    methods: {
        subscribe() {
            if (this.$refs.form.validate()) {
                axios.post('api/subscribe', {
                    'email': this.email
                }).then(res => {
                    this.snackbar = true
                    this.$refs.form.reset()
                }).catch(err => console.log(err.response))
            }

        },
        goToAlpine(){
             window.location.replace("http://www.alpinetrek.com.np/")
        },
        toFiftech(){
             window.location.replace("https://www.facebook.com/fiftechzone")
        }
    }
}
</script>
<style scoped>
    .assoc{
        cursor: pointer;
    }
</style>
