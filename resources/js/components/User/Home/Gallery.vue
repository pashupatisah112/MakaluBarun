<template>
<div>
    <v-container>
        <v-row justify="center" class="mt-10">
            <v-col cols="12" lg="6" md="8" align="center">
                <p class="text-h4 font-weight-bold">Memories</p>
            </v-col>
        </v-row>
        <v-row justify="center">
            <vueper-slides style="width:100%;" :slide-ratio="1 / 4" autoplay :arrows="false" class="no-shadow" :visible-slides="3" slide-multiple :gap="3" :breakpoints="{ 961: { visibleSlides: 2, slideMultiple: 2 },376: { visibleSlides: 1, slideMultiple: 1 } }">
                    <vueper-slide v-for="(slide, i) in memory" :key="i" :image="getImage(slide)" style="border:2px solid #BE9F50" />
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

        }
    }
}
</script>
