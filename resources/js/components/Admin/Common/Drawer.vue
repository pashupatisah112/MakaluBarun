<template>
    <v-navigation-drawer permanent app width="200px">
        <v-list-item>
            <v-list-item-avatar size="80" class="mx-auto">
                <v-img src="../images/logo.png"></v-img>
            </v-list-item-avatar>
        </v-list-item>

        <v-divider></v-divider>

        <v-list dense nav>
            <v-list-item v-for="item in items" :key="item.title" link :to="item.link">
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    data() {
        return {
            items: [{
                    title: 'Dashboard',
                    icon: 'mdi-view-dashboard',
                    link:'/ma-admin/dashboard'
                },
                {
                    title: 'Projects',
                    icon: 'mdi-briefcase-download',
                    link:'/ma-admin/projects'
                },
                {
                    title: 'Gallery',
                    icon: 'mdi-image',
                    link:'/ma-admin/gallery'
                },
                 {
                    title: 'Memory',
                    icon: 'mdi-image-filter-frames',
                    link:'/ma-admin/memory'
                },
                {
                    title: 'Slider',
                    icon: 'mdi-play-pause',
                    link:'/ma-admin/slider'
                },
                {
                    title: 'Messages',
                    icon: 'mdi-message-text',
                    link:'/ma-admin/messages'
                },
                {
                    title: 'Subscribers',
                    icon: 'mdi-bell-ring',
                    link:'/ma-admin/subscribers'
                },
            ],
        }
    },
}
</script>
