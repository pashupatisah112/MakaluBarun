<template>
<div>
    <v-carousel cycle height="600" show-arrows-on-hover hide-delimiters>
        <v-carousel-item v-for="(item,i) in promo" :key="i" :src="getImage(item)" :aspect-ratio="16/9" reverse-transition="fade-transition" transition="fade-transition">
            <v-card max-width="500" color="rgb(142, 83, 36, 0.4)" flat style="position:absolute;bottom:20%;" class="mx-16">
                <sequential-entrance fromTop delay="1000">
                    <v-card-subtitle class="mb-n8 text-h6 text-uppercase"><span class="para-font">{{item.title}}</span></v-card-subtitle>
                </sequential-entrance>

                <sequential-entrance delay="2000">

                    <p class="text-lg-h3 text-md-h4 text-sm-h5 text-uppercase para-font mt-3"><span class="para-font">{{item.tag}}</span></p>
                </sequential-entrance>

                <v-card-actions>
                    <sequential-entrance fromBottom delay="2000">
                        <v-hover v-slot="{ hover }">
                            <v-btn :elevation="hover ? 12 : 0" rounded dark color="prime" width="150" class="text-capitalize" @click="goToProjects">See More</v-btn>
                        </v-hover>
                    </sequential-entrance>
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
        },
        goToProjects() {
            this.$router.push({
                name: 'ProjectList',
                params: {
                    key: 'All'
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
