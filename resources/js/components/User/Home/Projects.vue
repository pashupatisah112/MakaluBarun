<template>
<div style="background-color:#EAEAEA">
    <v-container>
        <v-row justify="center" class="mt-10">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold">Our Recent Projects</p>
                <v-btn rounded dark color="prime" class="text-capitalize" @click="goToProjects">
                    View All Projects
                    <v-icon class="ml-2">mdi-arrow-right</v-icon>
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" lg="4" md="4" v-for="item in recent" :key="item.id">
                <sequential-entrance>
                    <v-card max-width="400" tile class=" mx-auto overflow-hidden">
                        <v-img :src="getImage(item)"></v-img>
                        <v-card-title @click="goToDetail(item)" class="hov">{{item.title}}</v-card-title>
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
                </sequential-entrance>
            </v-col>
        </v-row>
    </v-container>
     
</div>
</template>

<script>
export default {
    data() {
        return {
            recent: []
        }
    },
    mounted() {
        this.getRecentProjects()
    },
    methods: {
        getRecentProjects() {
            axios.get('api/getRecentProjects')
                .then(res => {
                    this.recent = res.data
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
        },
        goToProjects(){
            this.$router.push({
                name:'ProjectList',
                params:{key:'All'}
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
