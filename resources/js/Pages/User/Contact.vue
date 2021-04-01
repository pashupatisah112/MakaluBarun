<template>
<div>
    <v-container>
        <v-row justify="center" class="mt-2">
            <p class="text-h5 font-weight-bold">Contact Us</p>
        </v-row>
        <v-row>
            <v-col cols="12" lg="6" md="6" align="center">
                <v-row>
                    <v-col align="center">
                        <v-icon size="50" color="prime">mdi-map-marker</v-icon>
                        <p class="body-2 prime-text">Address</p>
                        <p class="body-2">Gokarneshwor-08, Narayantar <br>Kathmandu, Nepal</p>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col align="center">
                        <v-icon size="50" color="prime">mdi-phone</v-icon>
                        <p class="bpdy-2 prime-text">Phone</p>
                        <p class="body-2">+977 01 4914096</p>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col align="center">
                        <v-icon size="50" color="prime">mdi-email</v-icon>
                        <p class="bpdy-2 prime-text">Email</p>
                        <p class="body-2">esmartorder@gmail.com</p>
                    </v-col>
                </v-row>
            </v-col>
            <v-col cols="12" lg="6" md="6" align="center">
                <v-card rounded max-width="500" class="rounded-xl">
                    <div style="width:100%" class="text-center py-3 white--text mb-5 prime-back">Leave us a Message</div>
                    <v-form v-model="valid" ref="form">
                        <p class="mb-0 text-left mx-5">Full Name</p>
                        <v-text-field v-model="name" outlined dense class="mx-5" :rules="[validRules.required]"></v-text-field>

                        <p class="mb-0 text-left mx-5 mt-n3">Email</p>
                        <v-text-field v-model="email" dense outlined placeholder="someone@example.com" class="mx-5" :rules="[validRules.required]"></v-text-field>

                        <p class="mb-0 text-left mx-5 mt-n3">Message</p>
                        <v-textarea v-model="message" outlined placeholder="Write your message here..." class="mx-5" :rules="[validRules.required]"></v-textarea>

                        <v-btn class="mb-5 mx-auto" @click="sendMessage">Submit</v-btn>
                    </v-form>

                </v-card>
            </v-col>
        </v-row>
        <v-row class="my-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.5139086348054!2d85.31101251506196!3d27.701414882794214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1854cf6d91cf%3A0x652a2bcfde000123!2sKathmandu%20Mall!5e0!3m2!1sen!2snp!4v1617127704967!5m2!1sen!2snp" style="width:100%;border:0;height:400px" allowfullscreen="" loading="lazy"></iframe>
        </v-row>
    </v-container>

    <!-- snackbar -->
    <v-snackbar v-model="snackbar" timeout="3000" top>
        Your message has been recorded.  Thank you for supporting us.
        <template v-slot:action="{ attrs }">
            <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
                Close
            </v-btn>
        </template>
    </v-snackbar>
    <!-- end snackbar -->
</div>
</template>

<script>
export default {
    data() {
        return {
            valid: true,
            name: '',
            email: '',
            message: '',
            validRules: {
                required: value => !!value || "Required.",
            },
            snackbar: false
        }
    },
    methods: {
        sendMessage() {
            if (this.$refs.form.validate()) {
                axios.post('api/recordMessage',{
                    'name':this.name,
                    'email':this.email,
                    'message':this.message
                })
                    .then(res => {
                        this.snackbar = true
                        this.$refs.form.reset()
                    })
            }
        }
    },
}
</script>
