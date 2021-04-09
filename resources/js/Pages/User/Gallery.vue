<template>
<div>
    <v-container>
        <v-row justify="center" class="mt-10">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-h4 font-weight-bold">Gallery</p>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" lg="4" md="6" v-for="item in gallery" :key="item.id">
               <div style="max-width:376px;border:2px solid #BE9F50">
                    <v-img :src="getImage(item)"></v-img>
               </div>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            gallery: [],
            selectedImage: '',
        }
    },
    mounted() {
        this.getGallery()
    },
    methods: {
        getGallery() {
            axios.get('api/getGallery')
                .then(res => {
                    this.gallery = res.data
                    console.log(this.gallery)
                }).catch(err => console.log(err.response))
        },
        getImage(item) {
            return '../storage/' + item.image
        },
        openImage(item) {

        }
    }
}
</script>
