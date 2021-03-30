<template>
<div>
    <v-container>
        <v-row>
            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80">mdi-briefcase-download</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Projects</v-list-item-subtitle>
                                <v-list-item-title>{{project}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/projects">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
                </v-card>
            </v-col>
            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80">mdi-notebook</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Blogs</v-list-item-subtitle>
                                <v-list-item-title>{{stories}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/stories">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
                </v-card>
            </v-col>
            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80">mdi-account-group</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Team Members</v-list-item-subtitle>
                                <v-list-item-title>{{team}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/teams">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
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
            project: 0,
            team: 0,
            stories: 0
        }
    },
    mounted(){
        this.getDetail()
    },
    methods: {
        getDetail() {
            axios.get('api/getDashboardDetail').
            then(res => {
                this.project = res.data.project
                this.team = res.data.team
                this.stories = res.data.story
            })
        }
    }
}
</script>
