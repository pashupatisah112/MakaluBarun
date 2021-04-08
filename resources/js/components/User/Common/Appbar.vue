<template>
<div>
    <v-toolbar color="white" class="px-10 position-sticky">
        <v-btn text color="prime">
            <v-icon class="mr-5">mdi-phone</v-icon>
            <span class="font-weight-bold">+977 9841337185</span>
        </v-btn>

        <v-btn text class="mx-10 text-lowercase" color="prime">
            <v-icon class="mr-5">mdi-email</v-icon>
            <span class="font-weight-bold">info@mavwelfare.org</span>
        </v-btn>

        <v-spacer></v-spacer>

        <v-btn icon href="https://www.facebook.com/Makalu-Arun-Valley-Social-Welfare-100163585519928" target="_blank">
            <v-icon>mdi-facebook</v-icon>
        </v-btn>
        <v-btn icon target="_blank" href="https://www.instagram.com/_makalusocialwelfare/">
            <v-icon>mdi-instagram</v-icon>
        </v-btn>
        <v-btn icon >
            <v-icon>mdi-twitter</v-icon>
        </v-btn>
    </v-toolbar>

    <v-divider style="border:1px solid #BE9F50"></v-divider>

    <v-toolbar flat height="120" class="px-10">
        <v-img src="../images/logo.png" max-width="100"></v-img>
        <p class="text-h4 prime-text font-weight-bold mx-5">Makalu Arun Valley Social Welfare</p>
        <v-spacer></v-spacer>

        <v-btn rounded dark color="prime" class="text-capitalize mx-1 mbtn" x-large @click="donateDialog=true">
            <v-icon>mdi-currency-usd</v-icon>
            Donate
        </v-btn>
    </v-toolbar>

    <menubar></menubar>

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
                <v-btn dark color="sec" to="/contact-us" @click="donateDialog=false" rounded class="text-capitalize">Contact Us</v-btn>
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
