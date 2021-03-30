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
                    title: 'Blogs',
                    icon: 'mdi-notebook',
                    link:'/ma-admin/stories'
                },
                {
                    title: 'Teams',
                    icon: 'mdi-account-group',
                    link:'/ma-admin/teams'
                },
            ],
        }
    },
}
</script>
