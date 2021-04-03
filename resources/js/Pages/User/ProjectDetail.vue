<template>
<div>
    <v-container class="mt-5">
        <v-row justify="center">
            <p class="text-lg-h5 text-md-h6 text-sm-h6">{{title}}</p>
        </v-row>
        <v-row justify="space-between">
            <v-col cols="12" lg="4" md="4">
                <p class="body-2"><b>Started Date</b>: {{project.start_date}}</p>
                <p class="body-2"><b>Location: </b>{{project.location}}</p>
                <p class="body-2"><b>Ended Date: </b> {{project.ended_date}}</p>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12"  align="center">
                <v-img :src="getImage(project)" class="float-left mr-5"></v-img>
                <div v-html="project.detail"></div>
            </v-col>
        </v-row>
        <v-row v-if="project.status=='Upcoming'" class="ma-10" justify="center">
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
