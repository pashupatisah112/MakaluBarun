<template>
<div>
    <v-toolbar color="white" class="px-10 position-sticky hidden-sm-and-down" height="40">
        <v-btn text color="sec" small>
            <v-icon class="mr-5">mdi-phone</v-icon>
            <span class="font-weight-bold">+977 9841337185</span>
        </v-btn>

        <v-btn text class="mx-10 text-lowercase" color="sec" small>
            <v-icon class="mr-5">mdi-email</v-icon>
            <span class="font-weight-bold">info@mavwelfare.org</span>
        </v-btn>

        <v-spacer></v-spacer>

        <v-hover v-slot="{ hover }">
            <v-btn class="mx-2 " :elevation="hover ? 12 : 0" icon href="https://www.facebook.com/Makalu-Arun-Valley-Social-Welfare-100163585519928" target="_blank" small>
                <v-icon>mdi-facebook</v-icon>
            </v-btn>
        </v-hover>

        <v-hover v-slot="{ hover }">
            <v-btn class="mx-2" :elevation="hover ? 12 : 0" icon target="_blank" href="https://www.instagram.com/_makalusocialwelfare/" small>
                <v-icon>mdi-instagram</v-icon>
            </v-btn>
        </v-hover>

        <v-hover v-slot="{ hover }">
            <v-btn class="mx-2" :elevation="hover ? 12 : 0" icon small target="_blank" href="https://twitter.com/MakaluW">
                <v-icon>mdi-twitter</v-icon>
            </v-btn>
        </v-hover>
    </v-toolbar>

    <v-divider style="border:1px solid #BE9F50 hidden-sm-and-down"></v-divider>

    <v-toolbar flat height="120" class=" hidden-sm-and-down">
        <v-img src="../images/logo.png" max-width="100"></v-img>
        <p class="text-h4 prime-text font-weight-bold mx-5"><span class="title-font">Makalu Arun Valley Social Welfare</span></p>
        <v-spacer></v-spacer>

        <v-hover v-slot="{ hover }">
            <v-btn :elevation="hover ? 12 : 0" rounded dark color="sec" class="text-capitalize mx-1" x-large @click="donateDialog=true">
                <v-icon>mdi-currency-usd</v-icon>
                Donate
            </v-btn>
        </v-hover>
    </v-toolbar>
    <menubar>
    </menubar>

    <v-dialog v-model="donateDialog" max-width="500">
        <v-card img="../images/donate.jpg">
            <p class="text-center title">Donate for the future of childrens!</p>
            <v-card-subtitle class="text-center">
                Donate what you have - Money, Time, Skill, Knowledge.
            </v-card-subtitle>
            <v-card class="white--text mx-10 pa-5" style="background-color:#151515;opacity:0.7">
                <p class="font-weight-bold">You can directly deposit the donation amount in the following Bank Account or contact us for further process:</p>
                <span><b>Account Name:</b> Makalu Arun Valley Social Welfare</span><br>
                <span><b>Account No:</b> 01701017502172</span><br>
                <span><b>Bank Name:</b> Nabil Bank Ltd.</span><br>
                <span><b>Branch:</b> Durbarmarg</span><br>
            </v-card>
            <v-card-actions>
                <v-btn dark color="prime" to="/contact-us" @click="donateDialog=false" rounded class="text-capitalize mx-auto">Contact Us</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</div>
</template>

<script>
import Menubar from './Menubar';
export default {
    components: {
        Menubar
    },
    data() {
        return {
            donateDialog: false,

        }
    }
}
</script>

<style scoped>

</style>
