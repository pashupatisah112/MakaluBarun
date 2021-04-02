<template>
<div>
    <v-container class="mt-10">
        <v-row justify="center">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-h5 text-sm-h6 font-weight-bold">Latest Articles</p>
                <p class="body-1">Some of the thoughts and stories extracted from our experience through different specs and events.</p>
            </v-col>
        </v-row>
        <v-row class="mt-n10">
            <v-col cols="12" lg="4" md="4" v-for="item in blogs" :key="item.id">
                <v-hover v-slot="{ hover }">
                <v-card class="mx-auto my-12" max-width="374" :elevation="hover ? 2 : 16" :class="{ 'on-hover': hover }">
                    <v-img :aspect-ratio="16/9" :src="getImage(item)" class="rounded-lg"></v-img>
                    <v-card-title @click="goToDetails(item)" class="hov">{{item.title}}</v-card-title>
                    <v-card-text>
                        <v-row class="px-3">
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-calendar</v-icon>{{ item.created_at | moment("dddd, MMMM Do YYYY") }}</p>
                            <v-spacer></v-spacer>
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-account</v-icon>Author: {{item.author}}</p>
                        </v-row>

                    </v-card-text>

                </v-card>
                </v-hover>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            blogs:''
        }
    },
    mounted(){
       this.getRecentBlogs()
    },
    methods:{
        getRecentBlogs(){
            axios.get('api/getRecentBlogs')
            .then(res=>{
                console.log(this.blogs)
                this.blogs=res.data
            }).catch(err=>console.log(err.response))
        },
        getImage(item){
            return "../storage/"+item.image
        },
       goToDetails(item){
           this.$router.push({
               name:'Blog-Detail',
               params:{'id':item.id,'title':item.title}
           })
       }
    }
}
</script>
<style scoped>
    .hov{
        cursor: pointer;
        color: #8E5324;
    }
</style>
