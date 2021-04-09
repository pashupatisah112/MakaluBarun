<template>
<div style="background-color:#EAEAEA">
    <v-container>
        <v-row justify="center" class="mt-10">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-h4 font-weight-bold">Memories</p>
            </v-col>
        </v-row>
        <v-row justify="center" class="my-2">
            <!-- <v-slide-group class="pa-4" center-active show-arrows>
                <v-slide-item v-for="item in memory" :key="item.id">
                    <v-card class="pa-0 mx-5" max-width="376">
                        <v-img :src="getImage(item)"></v-img>
                    </v-card>
                </v-slide-item>
            </v-slide-group> -->
            
                <vueper-slides style="width:100%;" :slide-ratio="1 / 5" autoplay :arrows="false" class="no-shadow hidden-sm-and-down" :visible-slides="3" slide-multiple :gap="3" :breakpoints="{ 961: { visibleSlides: 2, slideMultiple: 2 },376: { visibleSlides: 1, slideMultiple: 1 } }">
                    <vueper-slide v-for="(item, i) in memory" :key="i" :image="getImage(item)" style="border:2px solid #BE9F50;color:white;">
                    </vueper-slide>
                </vueper-slides>
            

                <vueper-slides style="width:100%;" :slide-ratio="1 / 2" autoplay :arrows="false" class="no-shadow hidden-md-and-up" :visible-slides="3" slide-multiple :gap="3" :breakpoints="{ 961: { visibleSlides: 2, slideMultiple: 2 },376: { visibleSlides: 1, slideMultiple: 1 } }">
                    <vueper-slide v-for="(item, i) in memory" :key="i" :image="getImage(item)" style="border:2px solid #BE9F50;color:white;">
                    </vueper-slide>
                </vueper-slides>

        </v-row>
    </v-container>
    <v-container fluid>
        <v-row>
            <v-img src="../images/makalu.jpg" :aspect-ratio="16/3">

                <v-container fluid style="height:100%;color:white;background-color:#151515;opacity:0.7">

                    <v-row class="py-16">
                        <v-col cols="12" lg="4" md="4" align="center">
                            <v-icon size="50" color="white">mdi-map-marker</v-icon>
                            <p class="text-h5 font-weight-bold">Address</p>
                            <p class="body-1">Chetanshilmarg-26 Ranibari<br>Kathmandu, Nepal</p>
                        </v-col>
                        <v-col cols="12" lg="4" md="4" align="center">
                            <v-icon size="50" color="white">mdi-phone</v-icon>
                            <p class="text-h5 font-weight-bold">Phone</p>
                            <p class="title">+977 9841337185</p>
                        </v-col>
                        <v-col cols="12" lg="4" md="4" align="center">
                            <v-icon size="50" color="white">mdi-email</v-icon>
                            <p class="text-h5 font-weight-bold">Email</p>
                            <p class="title">info@mavwelfare.org</p>
                        </v-col>
                    </v-row>
                </v-container>
            </v-img>
        </v-row>
    </v-container>
    <v-overlay absolute :value="overlay">
        <v-card max-width="600" max-height="400" color="transparent">
            <v-btn icon @click="overlay = false">
                <v-icon color="white">mdi-close</v-icon>
            </v-btn>
            <v-img :src="getImage(image)"></v-img>

        </v-card>
    </v-overlay>
</div>
</template>

<script>
import {
    VueperSlides,
    VueperSlide
} from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
export default {
    components: {
        VueperSlides,
        VueperSlide
    },
    data() {
        return {
            memory: [],
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
            axios.get('api/getMemories')
                .then(res => {
                    this.memory = res.data
                    console.log(this.gallery)
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
