<template>
<div>
    <v-container>
        <v-row justify="center">
            <v-col cols="6" align="center">
                <p class="text-h5 font-weight-bold">Blogs</p>
                <p class="body-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </v-col>
        </v-row>
        <v-row v-if="blogs.data">
            <v-col cols="12" lg="4" md="4" v-for="item in blogs.data" :key="item.id">
                <v-card class="mx-auto mb-12" max-width="374" flat>

                    <v-img height="250" :src="getImage(item)" class="rounded-lg"></v-img>

                    <v-card-title @click="goToDetails(item)" style="cursor:pointer">{{item.title}}</v-card-title>
                    <v-card-text>
                        <v-row class="px-3">
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-calendar</v-icon>{{ item.created_at | moment("dddd, MMMM Do YYYY") }}</p>
                            <v-spacer></v-spacer>
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-account</v-icon>Author: {{item.author}}</p>
                        </v-row>

                    </v-card-text>

                </v-card>
            </v-col>
            <v-col cols="12" align="center">
                <v-pagination v-model="page" :length="blogs.last_page" prev-icon="mdi-menu-left" next-icon="mdi-menu-right" :total-visible="7" @input="input" @next="next" @previous="previous" class="my-5"></v-pagination>
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
            page: 1,
            blogs: []
        }
    },
    mounted() {
        this.getBlogs()
    },
    methods: {
        getBlogs() {
            axios
                .post("api/myBlogs?page=" + this.page)
                .then(res => {
                    this.blogs = res.data

                })
                .catch(err => console.log(err.response));
        },
        input(e) {
            this.page = e;
            this.getCollection();
        },
        getImage(item){
            return "../storage/"+item.image
        },
       goToDetails(item){
           this.$router.push({
               name:'Blog-Detail',
               params:{'id':item.id,'title':item.title}
           })
       },
        next(e) {
            axios
                .get(this.blogs.next_page_url)
                .then(res => {
                    this.blogs = res.data;
                })
                .catch(err => console.log(err.response));
        },
        previous() {
            axios
                .get(this.blogs.previous_page_url)
                .then(res => {
                    this.blogs = res.data;
                })
                .catch(err => console.log(err.response));
        }
    }
}
</script>
