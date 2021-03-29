<template>
<div>
    <v-container>
        <v-row>
            <v-col cols="12" lg="3" md="6">
                <v-card flat color="transparent">
                    <v-card-title>UNICARE</v-card-title>

                    <v-card-subtitle>
                        A small river named duden flows by their place and supplies it with with necessary elements.
                    </v-card-subtitle>
                    <v-card-actions>
                        <v-btn fab small>
                            <v-icon>mdi-twitter</v-icon>
                        </v-btn>
                        <v-btn fab small>
                            <v-icon>mdi-facebook</v-icon>
                        </v-btn>
                        <v-btn fab small>
                            <v-icon>mdi-instagram</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>

            </v-col>
            <v-col cols="12" lg="3" md="6">
                <v-card flat>
                    <v-card-title>
                        LATEST PROJECTS
                    </v-card-title>
                    <v-container>
                        <v-row v-for="(item,i) in 3" :key="i">
                            <v-col cols="4">
                                <v-img src="https://cdn.vuetifyjs.com/images/cards/cooking.png" class="rounded-lg"></v-img>
                            </v-col>
                            <v-col cols="8">
                                <p class="body-2">Eben now this is the greates.</p>
                                <p class="caption">24 September, 2018</p>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-col>
            <v-col cols="12" lg="3" md="6">
                <v-card flat>
                    <v-card-title>
                        QUICK LINKS
                    </v-card-title>
                    <v-btn text small class="my-1">
                        Home
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1">
                        About Us
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1">
                        Projects
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1">
                        Stories
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn text small class="my-1">
                        Contact
                    </v-btn>
                    <v-divider></v-divider>
                </v-card>

            </v-col>
            <v-col cols="12" lg="3" md="6">
                <p class="title">ENQUIRE US AT</p>
                <v-row>
                    <v-col cols="1">
                        <v-icon>mdi-map-marker</v-icon>
                    </v-col>
                    <v-col cols="11">
                        <p class="body-2">
                            203 Fake St. Mountain View, San Francisco, California, USA
                        </p>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="1">
                        <v-icon>mdi-cellphone</v-icon>
                    </v-col>
                    <v-col cols="11">
                        <p class="body-2">
                            9815790619
                        </p>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="1">
                        <v-icon>mdi-email</v-icon>
                    </v-col>
                    <v-col cols="11">
                        <p class="body-2">
                            pashupatisah112@gmail.com
                        </p>
                    </v-col>
                </v-row>

            </v-col>
        </v-row>
        <v-row>

        </v-row>
    </v-container>
</div>
</template>
