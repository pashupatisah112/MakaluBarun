<template>
<div>
    <v-container>
        <v-row>
            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80" color="prime">mdi-briefcase-download</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Projects</v-list-item-subtitle>
                                <v-list-item-title>{{project}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/projects" small style="opacity:0.6">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
                </v-card>
            </v-col>

            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80" color="prime">mdi-play-pause</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Sliders</v-list-item-subtitle>
                                <v-list-item-title>{{slider}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/slider" small style="opacity:0.6">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
                </v-card>
            </v-col>

            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80" color="prime">mdi-message-text</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Messages</v-list-item-subtitle>
                                <v-list-item-title>{{message}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/messages" small style="opacity:0.6">
                        See Detail
                        <v-icon>mdi-arrow-right</v-icon>
                    </v-btn>
                </v-card>
            </v-col>

            <v-col cols="4" align="center">
                <v-card max-width="300">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon size="80" color="prime">mdi-bell-ring</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-subtitle>Subscribers</v-list-item-subtitle>
                                <v-list-item-title>{{subscriber}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    <v-divider></v-divider>
                    <v-btn text to="/ma-admin/subscribers" small style="opacity:0.6">
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
            slider:0,
            message:0,
            subscriber:0
        }
    },
    mounted(){
        this.getDetail()
    },
    methods: {
        getDetail() {
            axios.get('/api/getDashboardDetail').
            then(res => {
                this.project = res.data.project
                this.slider=res.data.slider
                this.message=res.data.message
                this.subscriber=res.data.subscriber
            })
        }
    }
}
</script>
