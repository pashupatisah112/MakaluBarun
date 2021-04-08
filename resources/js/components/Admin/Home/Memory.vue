<template>
<v-container fluid>
    <!--memory list-->

    <v-data-table :headers="headers" :items="memory" class="elevation-1" :loading="loading" loading-text="Loading.....Please wait.">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Memory Management</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <!--add new memory-->
                <v-dialog v-model="memoryDialog" max-width="1200px" persistent>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn class="mr-2 float-right" fab dark color="sec" v-bind="attrs" v-on="on">
                            <v-icon dark>mdi-plus</v-icon>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-form ref="form" v-model="valid">
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.tag" outlined label="Tag for image" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="sec" text @click="close">Cancel</v-btn>
                                        <v-btn color="sec" text @click="save">Save</v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-dialog>
                <!--end add new-->
            </v-toolbar>
        </template>
        <!--course item actions-->
        <template v-slot:item.actions="{ item }">

            <!-- image view button-->
            <v-tooltip top>
                <template v-slot:activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip }" @click="viewImage(item)">
                        <v-icon small class="mr-2">
                            mdi-image
                        </v-icon>
                    </v-btn>
                </template>
                <span>View Image</span>
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
                    <v-card-text>Are you sure you want to delete this Image?</v-card-text>
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
            <p class="text-secondary">No Images</p>
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

    <!--image view button-->
    <v-dialog v-model="imageViewDialog" max-width="900" persistent>
        <v-card>
            <v-btn icon @click="imageViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-card-title>
                {{ selected.tag }}
            </v-card-title>
            <v-container fluid>
                <v-row justify="center">
                    <v-col cols="12" align="center">
                        <div v-if="selected.image">
                            <v-img :src="getImage(selected)" max-width="900" height="400" alt="image"></v-img>
                        </div>

                        <div v-else>
                            <v-btn icon outlined x-large @click="onButtonClick" :loading="isSelecting" class="mt-2">
                                <v-icon>mdi-image-plus</v-icon>
                            </v-btn>
                            <input ref="uploader" class="d-none" type="file" accept="image/*" @change="onFileChanged" />
                            <p>Add image</p>
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <!--end image view button-->
</v-container>
</template>

<script>
export default {
    data() {
        return {
            //datatable data loading
            loading: true,

            //adding form
            memoryDialog: false,
            valid: true,
            validRules: {
                required: value => !!value || "Required.",
            },
            //deleting
            deleteDialog: false,

            //memory view
            selected: '',
            selectedItem: '',

            //image view
            imageViewDialog: false,

            //image upload
            isSelecting: false,
            selectedFile: '',

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
                    text: "Tag",
                    value: "tag"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ],
            memory: [],
            editedIndex: -1,
            editedItem: {
                id: "",
                tag: "",
            },
            defaultItem: {
                id: "",
                tag: "",
            }
        };
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Image" : "Edit Image";
        },
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
    },
    mounted() {
        this.initialize()
    },
    methods: {
        initialize() {
            axios.get("api/getImage")
                .then(res => {
                    this.memory = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },

        editItem(item) {
            this.editedIndex = this.memory.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.selectedItem = item
            this.memoryDialog = true;
        },

        deleteItem(item) {
            const index = this.memory.indexOf(item);
            axios
                .delete("/api/memory/" + item.id)
                .then(res => {
                    this.memory.splice(index, 1)
                    this.deleteDialog = false
                    this.dataUpdateMsg = "Memory deleted successfully"
                    this.dataUpdateAlert = true
                })
        },

        close() {
            this.memoryDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.$refs.form.validate()) {

                if (this.editedIndex > -1) {
                    axios
                        .put("/api/memory/" + this.editedItem.id, {
                            'tag': this.editedItem.tag,
                        })
                        .then(res => {
                            this.memory.splice(this.memory.indexOf(this.selectedItem), 1, res.data)
                            this.close();
                            this.$refs.form.reset();
                            this.dataUpdateMsg = "Memory updated successfully.";
                            this.dataUpdateAlert = true;

                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                } else {

                    axios
                        .post("/api/memory", {
                            'tag': this.editedItem.tag,
                        })
                        .then(res => {
                            this.memory.push(res.data)
                            this.close();
                            this.dataUpdateMsg = "New Image added to memory."
                            this.dataUpdateAlert = true
                            this.$refs.form.reset()
                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                }
            }

        },
        viewImage(item) {
            this.selected = item
            this.imageViewDialog = true
        },
        getImage(selected) {
            return "../storage/" + selected.image
        },
        onButtonClick() {
            this.isSelecting = true;
            window.addEventListener(
                "focus",
                () => {
                    this.isSelecting = false;
                }, {
                    once: true
                }
            );

            this.$refs.uploader.click();
        },
        onFileChanged(e) {
            //console.log(e.target.files[0])
            const file = e.target.files[0];
            this.selectedFile = e.target.files[0];
            this.addImage();
        },
        addImage() {
            let data = new FormData();
            data.append(
                "selectedFile",
                this.selectedFile,
                this.selectedFile.name
            );
            data.append("id", this.selected.id);
            let settings = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            };
            axios
                .post("api/addMemoryImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.memory.splice(this.memory.indexOf(this.selected), 1, res.data)
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
    }
};
</script>
