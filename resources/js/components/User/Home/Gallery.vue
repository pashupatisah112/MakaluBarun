<template>
<div>
    <v-container>
        <v-row justify="center" class="mt-10">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-h5 text-sm-6">Picture Speaks Better Than Words.</p>
                <p class="body-1">Some of our memories through our journey and experience. No words to say what we do. Picture speaks itself.</p>
            </v-col>
        </v-row>
        <v-row>

            <v-col v-for="item in gallery" :key="item.id" class="d-flex child-flex" cols="4">
                <v-img :src="getImage(item)">
                    <template v-slot:placeholder>
                        <v-row class="fill-height ma-0" align="center" justify="center">
                            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                        </v-row>
                    </template>
                </v-img>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>
<script>
export default {
    data(){
        return{
            gallery:[],
            selectedImage:''
        }
    },
    mounted(){
        this.getGallery()
    },
    methods:{
        getGallery(){
           axios.get('api/getGallery')
           .then(res=>{
               this.gallery=res.data
           }).catch(err=>console.log(err.response))
        },
        getImage(item){
            return '../storage/'+item.image
        },
        openImage(item){

        }
    }
}
</script>
