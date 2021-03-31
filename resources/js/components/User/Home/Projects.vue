<template>
<div>
    <v-container class="mt-10">
        <v-row justify="center">
            <v-col cols="6" align="center">
                <p class="text-h5 font-weight-bold">Our Recent Projects</p>
                <p class="body-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" lg="6" md="6" v-for="(item,i) in 4" :key="i">
                <v-container fluid>
                    <v-row justify="center">
                        <v-col cols="6">
                            <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png" class="rounded-lg"></v-img>
                        </v-col>
                        <v-col cols="6">
                            <v-card class="mx-auto" max-width="374" flat>
                                <v-card-title>Lorem ipsum dolor</v-card-title>
                                <v-card-subtitle class="mt-n6">
                                    <v-row class="px-3">
                                        <v-icon small>mdi-clock</v-icon>
                                        <p class="caption mt-4">24 October,2018 </p>
                                    </v-row>
                                </v-card-subtitle>
                                <v-card-subtitle class="mt-n8">
                                    <v-row class="px-3">
                                        <v-icon small>mdi-map-marker</v-icon>
                                        <p class="caption mt-4">2736 Hinkle Deegan Lake Road</p>
                                    </v-row>
                                </v-card-subtitle>

                                <v-card-text>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>

            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            recent:[]
        }
    },
    mounted(){
        this.getRecentProjects()
    },
    methods:{
        getRecentProjects(){
             axios.get('api/getRecentProjects')
             .then(res=>{
                 this.recent=res.data
             }).catch(err=>console.log(err.response))
        }
    }
}
</script>
