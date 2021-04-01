<template>
<div>
    <v-carousel cycle height="600" show-arrows-on-hover hide-delimiters>
        <v-carousel-item v-for="(item,i) in promo" :key="i" :src="getImage(item)" reverse-transition="fade-transition" transition="fade-transition">
            <v-card color="transparent" max-width="500" flat style="position:absolute;left:5%;bottom:20%">
                <v-card-subtitle class="mb-n8 text-h6 text-uppercase">{{item.title}}</v-card-subtitle>
                <transition name="slide-fade" appear>
                    <v-card-title class="text-h3 text-uppercase">{{item.tag}}</v-card-title>
                </transition>
                <v-card-actions>
                    <v-btn rounded outlined width="150" class="text-capitalize mbtn" to="/projects">See More</v-btn>
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
            promo: []
        }
    },
    created() {
        this.getSliders()
    },
    methods: {
        getSliders() {
            axios.get('api/getSliders')
                .then(res => {
                    this.promo = res.data
                }).catch(err => console.log(err.respoonse))
        },
        getImage(item) {
            return "../storage/" + item.image
        }
    }
}
</script>

<style scoped>

</style>
