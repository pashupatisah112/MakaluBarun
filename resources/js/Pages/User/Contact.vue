<template>
<div class="norm-background">
        <v-container>
            <v-row justify="center" class="mt-2">
                <sequential-entrance fromTop>
                    <p class="text-lg-h4 text-md-h4 text-sm-h4 font-weight-bold"><span class="title-font">Contact Us</span></p>
                </sequential-entrance>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" lg="6" md="6">
                    <sequential-entrance fromLeft>
                        <v-list two-line color="transparent">
                            <v-list-item v-for="(item,i) in contact" :key="i">
                                <v-list-item-icon>
                                    <v-icon color="prime" size="50">
                                        {{item.icon}}
                                    </v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title class="text-h5 font-weight-bold prime-text"><span class="title-font">{{item.title}}</span></v-list-item-title>
                                    <v-list-item-subtitle class="body-1"><span class="para-font" v-html="item.subtitle"></span></v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </sequential-entrance>
                </v-col>

                <v-col cols="12" lg="6" md="6" align="center">
                    <sequential-entrance>
                        <v-card rounded max-width="500" class="rounded-xl">
                            <div style="width:100%" class="text-center py-3 white--text mb-5 prime-back">Leave us a Message</div>
                            <v-form v-model="valid" ref="form">
                                <p class="mb-0 text-left mx-5">Full Name</p>
                                <v-text-field v-model="name" outlined dense class="mx-5" :rules="[validRules.required]"></v-text-field>

                                <p class="mb-0 text-left mx-5 mt-n3">Email</p>
                                <v-text-field v-model="email" dense outlined placeholder="someone@example.com" class="mx-5" :rules="[validRules.required]"></v-text-field>

                                <p class="mb-0 text-left mx-5 mt-n3">Message</p>
                                <v-textarea v-model="message" outlined placeholder="Write your message here..." class="mx-5" :rules="[validRules.required]"></v-textarea>

                                <v-btn class="mb-5 mx-auto text-capitalize block" rounded dark color="prime" @click="sendMessage">Submit</v-btn>
                            </v-form>

                        </v-card>
                    </sequential-entrance>
                </v-col>

            </v-row>
            <v-row class="ma-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.6685193409926!2d85.31493271463867!3d27.727519182783645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb196af4434ba9%3A0xb2cf28a972c0b440!2sMakalu%20Arun%20Valley%20Social%20Welfare!5e0!3m2!1sen!2snp!4v1617319971613!5m2!1sen!2snp" style="width:100%;border:0;height:400px" allowfullscreen="" loading="lazy"></iframe>
            </v-row>
        </v-container>

        <!-- snackbar -->
        <v-snackbar v-model="snackbar" timeout="3000" top>
            Your message has been recorded. Thank you for supporting us.
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
            snackbar: false,
            contact: [{
                    icon: 'mdi-map-marker',
                    title: 'Address',
                    subtitle: 'Chetanshilmarg-26 Ranibari<br>Kathmandu, Nepal'
                },
                {
                    icon: 'mdi-phone',
                    title: 'Phone',
                    subtitle: '+977 9841337185'
                },
                {
                    icon: 'mdi-email',
                    title: 'Email',
                    subtitle: 'info@mavwelfare.org'
                }

            ]
        }
    },
    methods: {
        sendMessage() {
            if (this.$refs.form.validate()) {
                axios.post('api/recordMessage', {
                        'name': this.name,
                        'email': this.email,
                        'message': this.message
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
