<template>
<div>
    <v-carousel cycle height="600" show-arrows-on-hover hide-delimiters>
        <v-carousel-item v-for="(item,i) in promo" :key="i" :src="getImage(item)" reverse-transition="fade-transition" transition="fade-transition">
            <v-card color="transparent" max-width="500" flat style="position:absolute;left:5%;bottom:20%">
                <v-card-subtitle class="mb-n8 text-h6 text-uppercase">We can change the world together.</v-card-subtitle>
                <v-card-title class="text-h3 text-uppercase">Some text</v-card-title>
                <v-card-actions>
                    <v-btn rounded outlined dark width="150" class="text-capitalize" @click="goToDetails(item.product)">Read More</v-btn>
                </v-card-actions>
            </v-card>
        </v-carousel-item>
    </v-carousel>
</div>
</template>

<script>
export default {
    data() {
        return {
            arrows: true,
            promo: [{
                    src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
                },
            ]
        }
    },
    methods: {
        getImage(item) {
            return item.src
        }
    }
}
</script>
