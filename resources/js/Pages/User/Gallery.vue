<template>
<div>
    <v-container>
        <v-row justify="center" >
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-lg-h4 text-md-h4 text-sm-h5 font-weight-bold"><span class="title-font">Gallery</span></p>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" lg="4" md="6" v-for="item in gallery" :key="item.id" align="center">
                <sequential-entrance fromBottom>
                <div style="max-width:376px;border:2px solid #BE9F50">
                    <v-hover v-slot="{ hover }">
                        <div style="overflow: hidden;">
                            <v-img :src="getImage(item)" max-width="376" height="300" style="transition: transform .4s;" :class="{ 'on-hover': hover }">
                                <v-slide-y-reverse-transition hide-on-leave>
                                    <div v-if="hover" class="d-flex transition-fast-in-fast-out v-card--reveal" style="height: 5%;">
                                        <v-row style="background-color:rgba(0,0,0,0.9)" class="py-2 px-5 mb-2">
                                            <p style="color:white;float:left">{{item.tag}}</p>
                                            <v-spacer></v-spacer>
                                            <v-btn icon dark small class="mb-4" @click="openImage(item)">
                                                <v-icon color="white">mdi-fullscreen</v-icon>
                                            </v-btn>
                                        </v-row>
                                    </div>
                                </v-slide-y-reverse-transition>
                            </v-img>
                        </div>
                    </v-hover>
                </div>
                </sequential-entrance>
            </v-col>
        </v-row>
    </v-container>

    <v-overlay absolute :value="overlay">
        <v-card max-width="600" max-height="400" color="transparent">
                <v-btn icon @click="overlay = false">
                    <v-icon color="white">mdi-close</v-icon>
                </v-btn>
                    <v-img :src="getImage(image)" ></v-img>
            

        </v-card>
    </v-overlay>

</div>
</template>

<script>
export default {
    data() {
        return {
            gallery: [],
            selectedImage: '',
            overlay: false,
            image: ''
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
                }).catch(err => console.log(err.response))
        },
        getImage(item) {
            return '../storage/' + item.image
        },
        openImage(item) {
            this.image = item
            this.overlay = true
        }
    }
}
</script>

<style scoped>
.v-card--reveal {
    align-items: center;
    bottom: 0;
    justify-content: center;
    opacity: .5;
    position: absolute;
    width: 100%;
}
</style>
