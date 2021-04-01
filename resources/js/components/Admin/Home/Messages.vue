<template>
<v-container fluid>
    <!--messages list-->
    <v-data-table :headers="headers" :items="messages.data" class="elevation-1" :footer-props="{ itemsPerPageOptions: [5, 10, 15],itemsPerPageText:'messages per page' }" :server-items-length="messages.total" :loading="loading" loading-text="Loading.....Please wait." @pagination="paginate" item-key="id">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Message Management</v-toolbar-title>
            </v-toolbar>
        </template>
        <!--course item actions-->
        <template v-slot:item.actions="{ item }">
            <!--product view button-->
            <v-tooltip top>
                <template v-slot:activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip }" @click="viewMessage(item)">
                        <v-icon small class="mr-2">
                            mdi-eye
                        </v-icon>
                    </v-btn>
                </template>
                <span>View story</span>
            </v-tooltip>

            <!--end view button-->

            <!--delete section-->
            <v-dialog v-model="deleteDialog" persistent max-width="400" :retain-focus="false">
                <!--retain-focus helps prevent from maximum exceeding error caused when two items are deleted continuously. this is a bug so add this props compulsarily-->
                <template v-slot:activator="{ on: dialog, attrs }">
                    <v-tooltip top>
                        <template v-slot:activator="{ on: tooltip }">
                            <v-icon small @click="deleteDialog = true" v-bind="attrs" v-on="{ ...dialog, ...tooltip }">
                                mdi-delete
                            </v-icon>
                        </template>
                        <span>Delete</span>
                    </v-tooltip>
                </template>
                <v-card>
                    <v-card-title class="headline">Delete Confirmation</v-card-title>
                    <v-card-text>Are you sure you want to delete this message?</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" text @click="deleteDialog = false">Cancel</v-btn>
                        <v-btn color="green darken-1" text @click="deleteItem(item)">Confirm</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <!--end delete section-->

        </template>
        <!--end action-->
        <template v-slot:no-data>
            <p class="text-secondary">No Messages</p>
        </template>
    </v-data-table>
    <!--end course list-->

    <!--snackbar for data update message-->
    <v-snackbar v-model="dataUpdateAlert" :color="alertColor" :timeout="timeout">
        <v-icon color="white" style="margin-right:10px">mdi-checkbox-marked-circle</v-icon>
        {{ dataUpdateMsg }}
        <v-btn color="white" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
    <!--end snackbar-->

    <!--message view dialog-->
    <v-dialog max-width="600" persistent v-model="messageViewDialog">
        <v-card>
            <v-btn icon @click="messageViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <p class="text-h5"><b>Name:</b> {{ selected.name }}</p>
                        <p class="body-2"><b>Message:</b> {{selected.message }}</p>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <!--end message view dialog-->
</v-container>
</template>

<script>
export default {
    data() {
        return {
            //datatable data loading
            loading: true,

            //deleting
            deleteDialog: false,

            //story view
            messageViewDialog: false,
            selected: '',

            //snackbar
            alertColor: 'success',
            timeout: 3000,
            dataUpdateAlert: false,
            dataUpdateMsg: '',

            headers: [{
                    text: "#",
                    align: "start",
                    sortable: false,
                    value: "id"
                },
                {
                    text: "Name",
                    value: "name"
                },
                {
                    text: "Email",
                    value: "email"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ],
            messages: [],
        };
    },
    methods: {
        paginate($event) {
            axios
                .post("api/myMessages?page=" + $event.page, {
                    'per_page': $event.itemsPerPage
                })
                .then(res => {
                    this.messages = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },
        deleteItem(item) {
            const index = this.messages.data.indexOf(item);
            axios
                .delete("/api/messages/" + item.id)
                .then(res => {
                    this.messages.data.splice(index, 1)
                    this.deleteDialog = false
                    this.dataUpdateMsg = "Story deleted successfully"
                    this.dataUpdateAlert = true
                })
        },


        viewMessage(item) {
            this.selected = item
            this.messageViewDialog = true
        },
    }
};
</script>
