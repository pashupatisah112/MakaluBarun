<template>
<div>
    <v-app-bar color="white" height="80" fixed app>
        <v-img src="../images/logo.png" :aspect-ratio="16/16" max-width="75" class="my-2"></v-img>
        <p class="text-h6 ml-5 mb-n3 sec-text">MAV Welfare</p>
        <v-spacer></v-spacer>
        <div class="hidden-md-and-down">
            <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/home">Home</v-btn>
            <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/about-us">About Us</v-btn>
            <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/projects">Projects</v-btn>
            <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/blogs">Blogs</v-btn>
            <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/contact-us">Contact</v-btn>
            <v-btn dark rounded color="sec" class="text-capitalize mx-1" x-large @click="donateDialog=true">
                <v-icon>mdi-currency-usd</v-icon>
                Donate
            </v-btn>
        </div>
        <div class="hidden-lg-and-up">
            <template>
                <div class="text-center">
                    <v-menu transition="scale-transition">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon dark color="sec" x-large v-bind="attrs" v-on="on">
                                <v-icon>mdi-menu</v-icon>
                            </v-btn>
                        </template>
                        <v-list dense>
                            <v-list-item v-for="(item,i) in menu" :key="i" dense link :to="item.link">
                                <v-list-item-title v-text="item.title"></v-list-item-title>
                            </v-list-item>
                            <v-list-item dense link @click="donateDialog=true">
                                <v-list-item-title><v-icon>mdi-currency-usd</v-icon>Donate</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>
            </template>
        </div>
    </v-app-bar>

    <v-dialog v-model="donateDialog" max-width="500">
        <v-card>
            <p class="text-center title">Donate for the future of childrens!</p>
            <v-card-subtitle class="text-center">
                Donate what you have - Money, Time, Skill, Knowledge.
            </v-card-subtitle>
            <v-card-text>
                <p class="font-weight-bold">You can directly deposit the donation amount in the following Bank Account or contact us for further process:</p>
                <span><b>Account Name:</b> Makalu Arun Valley Social Welfare</span><br>
                <span><b>Account No:</b> 1234567890</span><br>
                <span><b>Bank Name:</b> ABC Bank</span><br>
                <span><b>Branch:</b> XYZ Branch</span><br>
            </v-card-text>
            <v-card-actions>
                <v-btn outlined dark color="sec" to="/contact-us" @click="donateDialog=false" rounded class="text-capitalize mbtn">Contact Us</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</div>
</template>

<script>
export default {
    data() {
        return {
            donateDialog: false,
            menu:[
                {title:'Home',link:'/home'},
                {title:'About Us',link:'/about-us'},
                {title:'Projects',link:'/projects'},
                {title:'Blogs',link:'/blogs'},
                {title:'Contact Us',link:'/contact-us'},
            ]
        }
    }
}
</script>
