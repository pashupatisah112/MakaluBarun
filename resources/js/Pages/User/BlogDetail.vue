<template>
<div>
    <v-container class="mt-5">
        <v-row>
            <v-col cols="12">
                <v-img :src="getImage(blog)" :aspect-ratio="16/7"></v-img>
                <p class="text-h5">{{blog.title}}</p>
                <v-row class="px-3">
                    <p class="caption mb-0">
                        <v-icon small class="mt-n1">mdi-calendar</v-icon>{{ blog.created_at | moment("dddd, MMMM Do YYYY") }}
                    </p>
                    <v-spacer></v-spacer>
                    <p class="caption mb-0">
                        <v-icon small class="mt-n1">mdi-account</v-icon>Author: Thilen Sherpa
                    </p>
                </v-row>
                <div v-html="blog.detail" class="mt-10"></div>
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

    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            blog: '',
            url:''
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
        this.url='https://mavwelfare.org/#/blog/'+this.id+'/'+this.title
        this.getBlogDetail()
    },
    methods: {
        getBlogDetail() {
            axios.post('api/getBlogDetails', {
                    'id': this.id
                })
                .then(res => {
                    console.log(res.data)
                    this.blog = res.data
                }).catch(err => console.log(err.response))
        },
        getImage(blog) {
            return '../storage/' + blog.image
        }
    }
}
</script>
