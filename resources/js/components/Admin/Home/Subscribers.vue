<template>
<v-container fluid>
    <!--subscribers list-->
    <v-data-table :headers="headers" :items="subscribers.data" class="elevation-1" :footer-props="{ itemsPerPageOptions: [5, 10, 15],itemsPerPageText:'subscribers per page' }" :server-items-length="subscribers.total" :loading="loading" loading-text="Loading.....Please wait." @pagination="paginate" item-key="id">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Subscriber Management</v-toolbar-title>
            </v-toolbar>
        </template>

        <template v-slot:no-data>
            <p class="text-secondary">No subscribers</p>
        </template>
    </v-data-table>
    <!--end course list-->
</v-container>
</template>

<script>
export default {
    data() {
        return {
            //datatable data loading
            loading: true,

            headers: [{
                    text: "#",
                    align: "start",
                    sortable: false,
                    value: "id"
                },
                {
                    text: "Email",
                    value: "email"
                },
            ],
            subscribers: [],
        };
    },
    methods: {
        paginate($event) {
            axios
                .post("/api/mySubscribers?page=" + $event.page, {
                    'per_page': $event.itemsPerPage
                })
                .then(res => {
                    this.subscribers = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },
    }
};
</script>
