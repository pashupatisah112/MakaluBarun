<template>
<div>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" lg="8" md="10" align="center">
                <p class="text-h4">About Makalu Arun</p>
                <p class="body-1">
                    Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.
                </p>
            </v-col>
        </v-row>
        <v-row>
            <v-tabs vertical color="white">
                <v-tab class="prime-back text-capitalize white-border">
                    Our Mission
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Vision
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Goal
                </v-tab>
                <v-tab class="prime-back text-capitalize white-border">
                    Our Values
                </v-tab>

                <v-tab-item style="background-color:black">
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et, tempor auctor, justo.
                                Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum sagittis.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat color="tert" min-height="190">
                        <v-card-text>
                            <p>
                                Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                                Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                                Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                                Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-row>
        <v-row justify="center" class="mt-16">
            <p class="text-h5">Our Team</p>
            
        </v-row>
        <v-row>
            <v-col cols="12" lg="4" md="4" v-for="i in 6" :key="i" align="center">
                <v-card max-width="300">
                <v-container>
                    <v-row>
                        <v-col align="center">
                            <v-list-item-avatar size="80">
                                <v-img src="../images/logo.png"></v-img>
                            </v-list-item-avatar>
                            <p class="title mb-n3">Shiva Chaudhary</p>
                            <v-card-subtitle>Chairman</v-card-subtitle>
                            <v-row justify="center">
                                <v-btn fab dark x-small color="prime">
                                    <v-icon>mdi-facebook</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small class="mx-5" color="prime">
                                    <v-icon>mdi-instagram</v-icon>
                                </v-btn>
                                <v-btn fab dark x-small color="prime">
                                    <v-icon>mdi-twitter</v-icon>
                                </v-btn>
                            </v-row>
                            <v-card-text>
                                Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on developing and deploying innovative products and services in the field of Process Automation, Digitization, Workflow Automation, Digital Financial Solutions and Insurance Sector.Pvt. Ltd. has been established to cater the growing needs in the space of IT Solution Development with special focus on.
                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-container>
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
