<template>
<div>
    <v-toolbar flat color="prime">
        <v-img src="../images/logo.png" max-width="45" class="hidden-md-and-up"></v-img>
        <p class="body-1 white--text mt-4 ml-3 hidden-md-and-up"><span class="title-font">MAV Welfare</span></p>
        <v-spacer></v-spacer>
        <div class="hidden-sm-and-down">
            <!-- home btn -->
            <v-btn text dark class="text-capitalize menu-text" large to="/home">Home</v-btn>
            <!-- end home btn -->
            
            <!-- about btn -->
            <v-menu open-on-hover bottom offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text dark class="text-capitalize menu-text" large v-bind="attrs" v-on="on">About Us</v-btn>
                </template>

                <v-list dark color="prime" >
                    <v-list-item  :to="item.link" v-for="(item, index) in about" :key="index">
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <!-- end about btn -->
            
            <!-- project btn -->
            <v-menu open-on-hover bottom offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text dark class="text-capitalize menu-text" large  v-bind="attrs" v-on="on">Projects</v-btn>
                </template>

                <v-list dark color="prime" >
                    <v-list-item v-for="(item, index) in project" :key="index" @click="goToProject(item)">
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <!-- end project btn -->

            <!-- gallery btn -->
            <v-btn text dark class="text-capitalize menu-text" large to="/gallery">Gallery</v-btn>
            <!-- end gallery btn -->

            <!-- contact btn -->
            <v-btn text dark class="text-capitalize menu-text" large to="/contact-us">Contact</v-btn>
            <!-- end contact btn -->

        </div>
        <div class="hidden-md-and-up">
            <template>
                <div class="text-center">
                    <v-menu transition="scale-transition">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon dark color="sec" x-large v-bind="attrs" v-on="on">
                                <v-icon color="white">mdi-menu</v-icon>
                            </v-btn>
                        </template>
                        <v-list dense>
                            <v-list-item dense to="/home">
                                <v-list-item-title>Home</v-list-item-title>
                            </v-list-item>
                            <v-list-item dense to="/about">
                                <v-list-item-title>About Us</v-list-item-title>
                            </v-list-item>
                            <v-list-item dense @click="goToProjects">
                                <v-list-item-title>Projects</v-list-item-title>
                            </v-list-item>
                            <v-list-item dense to="/gallery">
                                <v-list-item-title>Gallery</v-list-item-title>
                            </v-list-item>
                            <v-list-item dense to="/contact-us">
                                <v-list-item-title >Contact Us</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>
            </template>
        </div>

    </v-toolbar>
</div>
</template>

<script>
export default {
    data() {
        return {
            menu: [{
                    title: 'Home',
                    link: '/home'
                },
                {
                    title: 'About Us',
                    link: '/about-us'
                },
                {
                    title: 'Projects',
                    link: '/projects'
                },
                {
                    title: 'Gallery',
                    link: '/gallery'
                },
                {
                    title: 'Contact Us',
                    link: '/contact'
                },
            ],
            about: [{
                    title: 'Who We Are',
                    link: '/about#makalu'
                },
                {
                    title: "Founder's Detail",
                    link: '/about#founder-detail'
                },
                {
                    title: 'Our Mission',
                    link: '/about#mission'
                },
                {
                    title: 'Our Objectives',
                    link: '/about#goals'
                },
            ],
            project: [
                {
                    title: 'All Projects',
                    param:'All'
                },
                {
                    title: 'Finished Projects',
                    param:'Finished'
                },
                {
                    title: "Ongoing Projects",
                    param:"Current"
                },
                {
                    title: 'Upcoming Projects',
                    param: 'Upcoming'
                },
            ]
        }
    },
    methods:{
        goToProject(item){
            this.$router.push({
                name:'ProjectList',
                params:{key:item.param}
            })
        },
        goToProjects(){
            this.$router.push({
                name:'ProjectList',
                params:{key:'All'}
            })
        }
    }
}
</script>

<style scoped>
.menu-text {
    font-size: 20px;
    margin: 0 2px;
}

.router-link-active,
.router-link-exact-active {
    background-color: indianred;
    cursor: pointer;
}
</style>
