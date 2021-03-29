<template>
<div>
    <v-container>
        <v-row justify="center">
            <v-col cols="6" align="center">
                <p class="text-h5 font-weight-bold">Our Causes</p>
                <p class="body-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" lg="4" md="4" v-for="(item,i) in 3" :key="i">
                    <v-card class="mx-auto my-12" max-width="374" flat>

                        <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png" class="rounded-lg"></v-img>

                        <v-card-title>Cafe Badilico</v-card-title>

                        <v-card-text>
                            <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn rounded outlined light width="150" class="text-capitalize">Read Full</v-btn>
                        </v-card-actions>
                    </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {

        }
    }
}
</script>
