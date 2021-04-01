<template>
<div>
    <v-app-bar  color="white" height="80" fixed app>
        <v-img src="../images/logo.png" max-width="75" class="my-2"></v-img>
        <p class="text-h6 ml-5 mb-n3 sec-text">Makalu Arun Valley Welfare</p>
        <v-spacer></v-spacer>
        <v-btn text light rounded color="sec" class="text-capitalize mx-1" x-large to="/home">Home</v-btn>
        <v-btn text light rounded  color="sec" class="text-capitalize mx-1" x-large to="/about-us">About Us</v-btn>
        <v-btn text light rounded  color="sec" class="text-capitalize mx-1" x-large to="/projects">Projects</v-btn>
        <v-btn text light rounded  color="sec" class="text-capitalize mx-1" x-large to="/blogs">Blogs</v-btn>
        <v-btn text light rounded  color="sec" class="text-capitalize mx-1" x-large to="/contact-us">Contact</v-btn>
        <v-btn dark rounded  color="sec" class="text-capitalize mx-1" x-large @click="donateDialog=true">
            <v-icon>mdi-currency-usd</v-icon>
            Donate
        </v-btn>
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
                <v-btn outlined to="/contact-us" @click="donateDialog=false" rounded class="text-capitalize mbtn">Contact Us</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</div>
</template>

<script>
export default {
    data() {
        return {
            donateDialog: false
        }
    }
}
</script>
