<template>
<div>
    <v-container style="background-color:white" class="mb-10">
        <v-row justify="center">
            <v-col cols="12" lg="6" md="8" align="center">
                <sequential-entrance fromTop>
                    <p class="text-lg-h5 text-md-h5 text-sm-h6 font-weight-bold"><span class="title-font">{{key}} Projects</span></p>
                </sequential-entrance>

            </v-col>
        </v-row>
        <v-row v-if="projects.length">
            <v-col cols="12" v-for="item in projects" :key="item.id">
                <sequential-entrance fromBottom>
                    <v-container class="elevation-2">
                        <v-row justify="center">
                            <v-col cols="12" lg="3" md="12" class="pa-0" style="background-color:#BE9F50;color:white" align="center">
                                <v-chip x-small dark class="mt-16"><span class="title-font">{{item.status}}</span></v-chip>

                                <p class=" text-h4 font-weight-bold mb-0"><span class="title-font">{{item.title}}</span></p>
                                <v-card flat color="transparent" >
                                 
                                    <v-row class="px-5" justify="center">
                                         <v-icon color="white">mdi-clock</v-icon>
                                        <p class="mt-5 ml-2 white--text caption">
                                        <span class="title-font">{{item.start_date}} to <span v-if="item.status=='Finished'">{{item.ended_date}}</span><span v-if="item.status=='Current'">Ongoing</span></span></p>
                                    </v-row>
                                    <v-row class="px-5 mt-n8" justify="center">
                                        <v-icon color="white">mdi-map-marker</v-icon>
                                        <p class="mt-5 ml-2 white--text caption"><span class="title-font">{{item.location}}</span></p>
                                    </v-row>
                                </v-card>

                            </v-col>
                            <v-col cols="12" lg="5" md="12" class="px-10 pt-5" align="center">
                                <p class="body-2">
                                    <span class="para-font">
                                        {{item.intro}}
                                    </span>    
                                </p>
                                <v-btn light outlined rounded color="prime" class="mx-auto" @click="goToDetail(item)">See More</v-btn>
                            </v-col>
                            <v-col cols="12" lg="4" md="4" class="pa-0">
                                <v-img height="250" :src="getImage(item)"></v-img>
                            </v-col>
                        </v-row>
                    </v-container>
                </sequential-entrance>

            </v-col>
        </v-row>
        <v-row v-else justify="center">
            <breeding-rhombus-spinner :animation-duration="2000" :size="65" color="#8E5324" />
        </v-row>
    </v-container>
</div>
</template>

<script>
import {
    BreedingRhombusSpinner
} from 'epic-spinners'
export default {
    components: {
        BreedingRhombusSpinner
    },
    data() {
        return {
            projectType: 'All Projects',
            projects: []
        }
    },
    computed: {
        key() {
            return this.$route.params.key
        }
    },
    mounted() {
        this.getSpecificProjects()
        
    },
    methods: {
        getSpecificProjects() {
            axios.post('/api/getProjects', {
                    'type': this.key
                }).then(res => {
                    this.projects = res.data
                })
                .catch(err => console.log(err.response))
        },
        getImage(item) {
            return "../storage/" + item.image
        },
        goToDetail(item) {
            this.$router.push({
                name: 'Project-Detail',
                params: {
                    'id': item.id,
                    'title': item.title
                }
            })
        }
    }
}
</script>

<style scoped>
.hov {
    cursor: pointer;
    color: #8E5324;
}
</style>
