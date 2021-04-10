<template>
<div>
    <v-container>
        <!-- short detail -->
        <v-row justify="center" id="about">
            <v-col cols="12" lg="8" md="10" align="center">

                <v-icon color="prime" size="100">mdi-account-group</v-icon>
                <sequential-entrance fromTop>
                    <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold"><span class="title-font">About Makalu Arun</span></p>
                </sequential-entrance>

                <sequential-entrance fromBottom>
                    <p class="body-1">
                        <span class="para-font">
                            Makalu Arun Valley Welfare is a non profit organization which has been established with a mission to serve and hope for a peaceful and healthy Nepal. We are a group of people who believes in power of unity to change the world. Everyone can contribute to one another in some ways.
                        </span>
                    </p>
                </sequential-entrance>
            </v-col>
        </v-row>
        <!-- end short detail -->

        <!-- founder detail -->
        <v-row justify="center" id="founder-detail">
            <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold"><span class="title-font">Founder Detail</span></p>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" lg="4" md="5" align="center">
                <sequential-entrance fromLeft>
                    <v-card max-width="300" class=" pa-5">
                        <v-col align="center">
                            <v-list-item-avatar size="120" style="border:2px solid #8E5324;">
                                <v-img src="../images/logo.png"></v-img>
                            </v-list-item-avatar>
                            <p class="title mb-n3">Full Name</p>
                            <v-card-subtitle>Position</v-card-subtitle>
                            <v-row justify="center">
                                <v-btn fab dark x-small color="prime" href="getFbLink(item)" target="_blank">
                                    <v-icon>mdi-facebook</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small class="mx-5" href="getInstaLink(item)" color="prime" target="_blank">
                                    <v-icon>mdi-instagram</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small color="prime" href="getTwitterLink(item)" target="_blank">
                                    <v-icon>mdi-twitter</v-icon>
                                </v-btn>
                            </v-row>
                        </v-col>
                    </v-card>

                </sequential-entrance>

            </v-col>
            <v-col cols="12" lg="8" md="7" align="center">
                <sequential-entrance>
                    <v-card max-width="1000" max-height="300" flat>
                        <v-card-title class="prime-text mt-lg-16">
                            <span style="font-family:Marck Script">
                                <v-icon color="prime">mdi-format-quote-open</v-icon>
                                We want a peaceful and healthy Nepal where all the communities have liberties to exercise their basic rights & need, lead a secure, peaceful and healthy life and mainstreaming them into the development process.
                                <v-icon color="prime">mdi-format-quote-close</v-icon>
                            </span>
                        </v-card-title>
                    </v-card>
                </sequential-entrance>
            </v-col>

        </v-row>
        <!-- end founder details -->

        <!-- mission -->
        <v-row justify="center" class="mt-10" id="mission">
            <v-col cols="12" lg="10" md="8" align="center">
                <sequential-entrance fromTop>
                    <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold"><span class="title-font">Our Mission</span></p>
                </sequential-entrance>
                <sequential-entrance fromBottom>
                    <p class="body-1">
                        <span class="para-font">
                            We want a peaceful and healthy Nepal where all the communities have liberties to exercise their basic rights & need, lead a secure, peaceful and healthy life and mainstreaming them into the development process. A community where every individual has access to basic needs and requirements.
                        </span>
                    </p>
                </sequential-entrance>
            </v-col>

        </v-row>
        <!-- end mission -->

        <!-- objective -->
        <v-row id="goals">
            <v-col cols="12" align="center">
                <sequential-entrance fromBottom>

                    <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold"><span class="title-font">Our Goals and Objectives</span></p>
                </sequential-entrance>

                <v-row>
                    <v-col cols="6" lg="4" md="4" v-for="(item,i) in goals" :key="i">
                        <sequential-entrance>

                            <v-card flat color="transparent">
                                <v-col align="center">
                                    <div class="obj prime-back elevation-10">
                                        <v-icon dark class="mt-5" size="60">{{item.icon}}</v-icon>
                                    </div>
                                    <p class="body-1 mt-2" @click="showDetail(item)"><span class="title-font obj-text">{{item.title}}</span></p>

                                </v-col>
                            </v-card>

                        </sequential-entrance>

                    </v-col>
                </v-row>
            </v-col>

        </v-row>
        <!-- end objectives -->

        <v-dialog v-model="objDialog" max-width="400">
            <v-card flat>
                <v-card-title>
                    <v-icon color="prime" class="mr-2">{{objIcon}}</v-icon>{{objTitle}}
                </v-card-title>
                <v-card-text>
                    {{objDetail}}
                </v-card-text>
            </v-card>
        </v-dialog>

    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            teams: [],
            expand: false,
            goals: [{
                    'icon': 'mdi-cast-education',
                    'title': 'Fund For Education',
                    'detail': 'We aim at providing quality education to children and underprivileged group of remote areas by facilitating schools with different resources and equipments by raising funds.'
                },
                {
                    'icon': 'mdi-hospital-box',
                    'title': 'Improve Health Quality',
                    'detail': 'Provide health services to needy and poor people by providing free health check up services and facilitate health sectora with necessary equipments'
                },
                {
                    'icon': 'mdi-cup-water',
                    'title': 'Drinking Water For All',
                    'detail': 'Provide safe drinking water to rural areas where people have to travel long distances for drinking water.'
                },
                {
                    'icon': 'mdi-account-group',
                    'title': 'End Social Discrimination',
                    'detail': 'End up untouchability, social discriminations, malpractice abusea and superstition in the societ to shed the light on equality and well being of uniform society.'
                },
                {
                    'icon': 'mdi-teach',
                    'title': 'Awareness Programmes',
                    'detail': 'Create different youth based social awareness programmes about education,public health, environmental health and sanitization.'
                },
                {
                    'icon': 'mdi-office-building',
                    'title': 'Rebuilding Projects',
                    'detail': 'Rebuilding and renovation of educational institutions and health centers caused due to natural calamities.'
                },
                {
                    'icon': 'mdi-home-account',
                    'title': 'Rehabilitation And Renovation',
                    'detail': 'Help people to rehabilitate and restore during divine and natural calamities like flood, landslides, earthquakes, etc.'
                },
                {
                    'icon': 'mdi-head-lightbulb',
                    'title': 'Training Campaign',
                    'detail': 'We also conduct different skilled and employment base training to uplift the econnomics status of poor and marzinalied groups.'
                },
                {
                    'icon': 'mdi-account-heart',
                    'title': 'Volunteering',
                    'detail': 'Look after national and international volunteers who are willing to volunteer in the organizational projects.'
                },
            ],
            objIcon: '',
            objTitle: '',
            objDetail: '',
            objDialog: false
        }
    },

    methods: {
        showDetail(item) {
            this.objIcon = item.icon
            this.objTitle = item.title
            this.objDetail = item.detail
            this.objDialog = true
        },
    }
}
</script>

<style scoped>
.obj-card {
    border-top-left-radius: 40px;
    border-bottom-right-radius: 40px;
}

.obj {
    width: 100px;
    height: 100px;
    border-top-left-radius: 40px;
    border-bottom-right-radius: 40px;
    transition: 0.5s;
}

.obj:hover {
    border-top-right-radius: 40px;
    border-bottom-left-radius: 40px;
    border-top-left-radius: 0px;
    border-bottom-right-radius: 0px;
    transform: border-radiu 2s;
}

.obj-text {
    cursor: pointer;
    transition: 0.3s;
}

.obj-text:hover {
    color: #8E5324;
    font-size: 20px;
    font-weight: bold
}
</style>
