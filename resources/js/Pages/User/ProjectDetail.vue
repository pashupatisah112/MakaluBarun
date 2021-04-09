<template>
<div>
    <v-container class="mt-5 mb-10">
        <v-row justify="center">
            <p class="text-lg-h4 text-md-h5 text-sm-h6 font-weight-bold">{{title}}</p>
        </v-row>
        <v-row justify="space-between">
            <p class="body-2 text-secondary"><b>Started Date</b>: {{project.start_date}}</p>
            <p class="body-2 text-secondary"><b>Location: </b>{{project.location}}</p>
            <p class="body-2 text-secondary"><b>Ended Date: </b> {{project.ended_date}}</p>
        </v-row>
        <v-row>
            <v-col cols="12" class="pa-0">
                <div style="border:2px solid #BE9F50;float:left" class="mr-5 mb-b">
                    <v-img :src="getImage(project)" max-width="400"></v-img>
                </div>

                <div v-html="project.detail" class="mr-5"></div>

            </v-col>

        </v-row>
        <v-row justify="center">
            <p class="body-1 clearmx-2 font-weight-bold">Share this: </p>
            <ShareNetwork network="facebook" :url="url" :title="title" description="Blogs and stories by Makalu Arun Valley Welfare." quote="The worlds need you for change." hashtags="Makalu_Arun_Valley_Welfare,blogs">
                <v-btn max-width="150" small rounded color="#3b5998" dark class="text-capitalize mx-2 mt-n2">
                    <v-icon class="mx-2 text-capitalize x-small">mdi-facebook</v-icon>
                    Facebook
                </v-btn>
            </ShareNetwork>
            <ShareNetwork network="twitter" :url="url" :title="title" description="Blogs and stories by Makalu Arun Valley Welfare." quote="The worlds need you for change." hashtags="Makalu_Arun_Valley_Welfare,blogs">
                <v-btn max-width="150" small rounded color="#00acee" dark class="text-capitalize mx-2 mt-n2">
                    <v-icon class="mr-2 text-capitalize x-small">mdi-twitter</v-icon>
                    Twitter
                </v-btn>
            </ShareNetwork>
            <ShareNetwork network="linkedin" :url="url" :title="title" description="Blogs and stories by Makalu Arun Valley Welfare." quote="The worlds need you for change." hashtags="Makalu_Arun_Valley_Welfare,blogs">
                <v-btn max-width="150" small rounded color="#0072b1" dark class="text-capitalize mx-2 mt-n2">
                    <v-icon class="mr-2 text-capitalize x-small">mdi-facebook</v-icon>
                    Linked In
                </v-btn>
            </ShareNetwork>
        </v-row>
        <v-row v-if="!project.status=='Finished'" class="ma-10" justify="center">
            <v-btn rounded dark class="text-capitalize" color="sec" @click="donateDialog=true">Donate for this project</v-btn>
        </v-row>
    </v-container>

    <v-dialog v-model="donateDialog" max-width="500">
        <v-card>
            <p class="text-center title">Donate for the future of childrens!</p>
            <v-card-subtitle class="text-center">
                Donate what you have - Money, Time, Skill, Knowledge.
            </v-card-subtitle>
            <v-card-text>
                <p class="font-weight-bold">You can directly deposit the donation amount in the following Bank Account or contact us for further process:</p>
                <span><b>Account Name:</b> Makalu Arun Valley Social Welfare</span><br>
                <span><b>Account No:</b> 1234567890</span><br>
                <span><b>Bank Name:</b> ABC Bank</span><br>
                <span><b>Branch:</b> XYZ Branch</span><br>
            </v-card-text>
            <v-card-actions>
                <v-btn to="/contact-us" color="sec" @click="donateDialog=false" rounded class="text-capitalize">Contact Us</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
export default {
    data() {
        return {
            project: '',
            donateDialog: false,
            url: ''
        }
    },
    computed: {
        id() {
            return this.$route.params.id
        },
        title() {
            return this.$route.params.title
        }
    },
    mounted() {
        this.url = 'https://mavwelfare.org/#/project/' + this.id + '/' + this.title
        this.getProjectDetail()
    },
    methods: {
        getProjectDetail() {
            axios.post('api/getProjectDetail', {
                    'id': this.id
                })
                .then(res => {
                    this.project = res.data
                }).catch(err => console.log(err.response))
        },
        getImage(project) {
            return '../storage/' + project.image
        }
    }
}
</script>
