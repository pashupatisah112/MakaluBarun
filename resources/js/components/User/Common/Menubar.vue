<template>
<div>
    <v-toolbar flat color="prime">
        <v-spacer></v-spacer>
        <div class="hidden-md-and-down">
            <v-btn text dark class="text-capitalize menu-text" large to="/home">Home</v-btn>
            <v-btn text dark class="text-capitalize menu-text" large to="/about-us">About Us</v-btn>
            <v-btn text dark class="text-capitalize menu-text" large to="/projects">Projects</v-btn>
            <v-btn text dark class="text-capitalize menu-text" large to="/gallery">Gallery</v-btn>
            <v-btn text dark class="text-capitalize menu-text" large to="/contact-us">Contact</v-btn>

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
                                <v-list-item-title>
                                    <v-icon>mdi-currency-usd</v-icon>Donate
                                </v-list-item-title>
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
                    title: 'Blogs',
                    link: '/blogs'
                },
                {
                    title: 'Contact Us',
                    link: '/contact-us'
                },
            ]
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
