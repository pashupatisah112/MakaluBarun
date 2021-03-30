<template>
<div>
    <v-app-bar flat color="white" height="80">
        <v-img src="../images/logo.png" max-width="75" class="my-2"></v-img>
        <v-spacer></v-spacer>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/home">Home</v-btn>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/about-us">About Us</v-btn>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/projects">Projects</v-btn>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/about-us)">Team</v-btn>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/blogs">Blogs</v-btn>
        <v-btn text light color="sec" class="text-capitalize" x-large to="/contact-us">Contact</v-btn>
        <v-btn dark color="sec" class="text-capitalize" x-large flat tile>Donate</v-btn>
    </v-app-bar>

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
