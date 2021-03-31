<template>
<div>
    <v-container class="mt-10">
        <v-row justify="center">
            <v-col cols="6" align="center">
                <p class="text-h5 font-weight-bold">Latest Articles</p>
                <p class="body-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </v-col>
        </v-row>
        <v-row class="mt-n10">
            <v-col cols="12" lg="4" md="4" v-for="(item,i) in 3" :key="i">
                <v-card class="mx-auto my-12" max-width="374" flat>

                    <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png" class="rounded-lg"></v-img>

                    <v-card-title>Lorem ipsum</v-card-title>
                    <v-card-text>
                        <v-row class="px-3">
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-calendar</v-icon>12 November 2018</p>
                            <v-spacer></v-spacer>
                            <p class="caption mb-0"><v-icon small class="mt-n1">mdi-account</v-icon>Author: Thilen Sherpa</p>
                        </v-row>

                    </v-card-text>

                    <v-card-text>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </v-card-text>
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
