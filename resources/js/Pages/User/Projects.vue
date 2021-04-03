<template>
<div>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" lg="6" md="8" align="center">
                <sequential-entrance fromTop>
                    <p class="text-h5 text-sm-h6">Our Projects</p>
                </sequential-entrance>

            </v-col>
        </v-row>
        <v-row v-if="projects">
            <v-col cols="12" lg="6" md="6" v-for="item in projects" :key="item.id">
                <sequential-entrance fromBottom>

                    <v-container class="elevation-2">
                        <v-row justify="center">
                            <v-col cols="12" lg="6" md="12">
                                <v-img height="250" :src="getImage(item)" class="rounded-lg"></v-img>
                            </v-col>
                            <v-col cols="12" lg="6" md="12">
                                <v-hover v-slot="{ hover }" close-delay="200">
                                    <v-card max-width="400" class=" mx-auto overflow-hidden" flat :elevation="hover ? 16 : 0" :class="{ 'on-hover': hover }">
                                        <v-chip x-small dark class="ml-4">{{item.status}}</v-chip>
                                        <v-card-title @click="goToDetail(item)" class="mt-n4 hov">{{item.title}}</v-card-title>
                                        <v-card-subtitle class="mt-n6">
                                            <v-row class="px-3">
                                                <v-icon small>mdi-clock</v-icon>
                                                <p class="caption mt-4 ml-1">{{item.ended_date}} </p>
                                            </v-row>
                                        </v-card-subtitle>
                                        <v-card-subtitle class="mt-n8">
                                            <v-row class="px-3">
                                                <v-icon small>mdi-map-marker</v-icon>
                                                <p class="caption mt-4 ml-1">{{item.location}}</p>
                                            </v-row>
                                        </v-card-subtitle>

                                        <v-card-text class="mt-n3">
                                            <div>{{item.intro}}</div>
                                        </v-card-text>
                                    </v-card>
                                </v-hover>
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
            projects: []
        }
    },
    mounted() {
        this.getProjects()
    },
    methods: {
        getProjects() {
            axios.get('api/getProjects')
                .then(res => {
                    this.projects = res.data
                }).catch(err => console.log(err.response))
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
