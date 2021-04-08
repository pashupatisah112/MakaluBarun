<template>
<div>
    <v-container>
        <!-- short detail -->
        <v-row justify="center">
            <v-col cols="12" lg="8" md="10" align="center">
                <sequential-entrance fromTop>
                    <v-icon color="sec">mdi-account-group</v-icon>
                    <p class="text-h5 text-sm-h6">Who We Are</p>
                </sequential-entrance>

                <sequential-entrance fromTop>
                    <p class="body-2">
                        Makalu Arun Valley Welfare is a non profit organization which has been established with a mission to serve and hope for a peaceful and healthy Nepal. We are a group of people who believes in power of unity to change the world. Everyone can contribute to one another in some ways.
                    </p>
                </sequential-entrance>
            </v-col>
        </v-row>
        <!-- end short detail -->

        <!-- objectives -->
        <!-- <v-row>
            <v-tabs vertical color="white">
                <v-tab class="prime-back text-capitalize white-border">
                    Our Mission
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Vision
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Goal
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Values
                </v-tab>

                <v-tab-item style="background-color:black">
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
                                Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-row> -->
        <v-row>
            <v-col cols="12" align="center">
                <sequential-entrance fromBottom>

                    <p class="text-h5 text-sm-h6">Our Goals and Objectives</p>
                </sequential-entrance>

                <v-row>
                    <v-col cols="6" lg="4" md="4" v-for="(item,i) in goals" :key="i">
                        <sequential-entrance>

                            <v-card flat>
                                <v-col align="center">
                                    <div class="obj prime-back elevation-10">
                                        <v-icon dark class="mt-5" size="60">{{item.icon}}</v-icon>
                                    </div>
                                    <p class="body-1 mt-2 obj-text" @click="showDetail(item)">{{item.title}}</p>

                                </v-col>
                            </v-card>
                        </sequential-entrance>

                    </v-col>
                </v-row>
            </v-col>

        </v-row>
        <!-- end objectives -->

        <!-- team -->
        <v-row justify="center" class="mt-16">
            <p class="text-h5 text-sm-h6">Meet Our Team</p>
        </v-row>
        <v-row>
            <v-col cols="12" lg="3" md="4" v-for="item in teams" :key="item.id" align="center">
                <sequential-entrance>

                    <v-card max-width="300">
                        <v-col align="center">
                            <v-list-item-avatar size="120" style="border:2px solid #8E5324;">
                                <v-img :src="getImage(item)"></v-img>
                            </v-list-item-avatar>
                            <p class="title mb-n3">{{item.fname+' '}}{{item.lname}}</p>
                            <v-card-subtitle>{{item.position}}</v-card-subtitle>
                            <v-row justify="center">
                                <v-btn fab dark x-small color="prime" :href="getFbLink(item)" target="_blank">
                                    <v-icon>mdi-facebook</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small class="mx-5" :href="getInstaLink(item)" color="prime" target="_blank">
                                    <v-icon>mdi-instagram</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small color="prime" :href="getTwitterLink(item)" target="_blank">
                                    <v-icon>mdi-twitter</v-icon>
                                </v-btn>
                            </v-row>
                            <v-btn v-if="!expand" icon color="primary" x-small @click="expand=true" class="mt-4">
                                <v-icon>
                                    mdi-chevron-down
                                </v-icon>
                            </v-btn>

                            <v-expand-transition>
                                <v-card v-show="expand" flat class="mt-10 position-absolute">
                                    <v-card-text>
                                        {{item.about}}
                                    </v-card-text>
                                </v-card>
                            </v-expand-transition>

                            <v-btn v-if="expand" icon color="primary" x-small @click="expand=false" class="mt-4">
                                <v-icon>
                                    mdi-chevron-up
                                </v-icon>
                            </v-btn>
                        </v-col>
                    </v-card>
                    </sequential-entrance>

            </v-col>
        </v-row>
        <!-- end team -->

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
    mounted() {
        this.getTeams()
    },
    methods: {
        showDetail(item) {
            this.objIcon = item.icon
            this.objTitle = item.title
            this.objDetail = item.detail
            this.objDialog = true
        },
        getTeams() {
            axios.get('api/getTeams')
                .then(res => {
                    this.teams = res.data
                }).catch(err => console.log(err.response))
        },
        getImage(item) {
            return "../storage/" + item.image
        },
        getFbLink(item) {
            return item.fb_link
        },
        getInstaLink(item) {
            return item.insta_link
        },
        getTwitterLink(item) {
            return item.twitter_link
        }
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
}

.obj-text:hover {
    color: #8E5324;
    font-size: 30px;
}
</style>
