<template>
<v-container fluid>
    <!--slider list-->
    <v-data-table :headers="headers" :items="sliders" class="elevation-1" :loading="loading" loading-text="Loading.....Please wait.">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Slider Management</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <!--add new story-->
                <v-dialog v-model="sliderDialog" max-width="1200px" persistent>
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
                                            <v-text-field v-model="editedItem.title" outlined label="Slider title" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.tag" outlined label="Slider tag" dense :rules="[
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

            <!--edit button-->
            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <v-icon small class="mr-2" @click="editItem(item)" v-bind="attrs" v-on="on">
                        mdi-pencil
                    </v-icon>
                </template>
                <span>Edit</span>
            </v-tooltip>

            <!--end edit button-->

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
                    <v-card-text>Are you sure you want to delete this slider?</v-card-text>
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
            <p class="text-secondary">No Sliders</p>
        </template>
    </v-data-table>
    <!--end course list-->

    <!--snackbar for data update message-->
    <v-snackbar v-model="dataUpdateAlert" :color="alertColor" :timeout="timeout">
        <v-icon color="white" style="margin-right:10px">mdi-checkbox-marked-circle</v-icon>
        {{ dataUpdateMsg }}
        <v-btn color="white" text @click="dataUpdateAlert = false">Close</v-btn>
    </v-snackbar>
    <!--end snackbar-->

    <!--image view button-->
    <v-dialog v-model="imageViewDialog" max-width="900" persistent>
        <v-card>
            <v-btn icon @click="imageViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-card-title>
                {{ selected.title }}
            </v-card-title>
            <v-container fluid>
                <v-row justify="center">
                    <v-col cols="12" align="center">
                        <div v-if="selected.image">
                            <v-img :src="getImage(selected)" max-width="900" height="400" alt="image"></v-img>
                        </div>

                        <div>
                            <div v-if="selected.image">
                                <v-btn icon outlined x-large class="mt-2" @click="onButtonClick" :loading="isSelecting">
                                    <v-icon>mdi-image-plus</v-icon>
                                </v-btn>
                                <input ref="uploader" class="d-none" type="file" accept="image/*" @change="changeImage" />
                                <p>Change image</p>
                            </div>
                            <div v-else>
                                <v-btn icon outlined x-large @click="onButtonClick" :loading="isSelecting" class="mt-2">
                                    <v-icon>mdi-image-plus</v-icon>
                                </v-btn>
                                <input ref="uploader" class="d-none" type="file" accept="image/*" @change="onFileChanged" />
                                <p>Add image</p>
                            </div>

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
            sliderDialog: false,
            valid: true,
            validRules: {
                required: value => !!value || "Required.",
            },

            //deleting
            deleteDialog: false,

            //story view
            productViewDialog: false,
            selected: '',

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
                    text: "Title",
                    value: "title"
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
            sliders: [],
            editedIndex: -1,
            editedItem: {
                id: "",
                title: "",
                tag:""
            },
            defaultItem: {
                id: "",
                title: "",
                tag:""
            }
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Slider" : "Edit Slider";
        },
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
    },
    mounted(){
        this.initialize()
    },
    methods: {
        initialize() {
            axios
                .get("/api/sliders")
                .then(res => {
                    this.sliders = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },

        editItem(item) {
            this.editedIndex = this.sliders.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.selectedItem = item
            this.sliderDialog = true;
        },

        deleteItem(item) {
            const index = this.sliders.indexOf(item);
            axios
                .delete("/api/sliders/" + item.id)
                .then(res => {
                    this.sliders.splice(index, 1)
                    this.deleteDialog = false
                    this.dataUpdateMsg = "Slider deleted successfully"
                    this.dataUpdateAlert = true
                })
        },

        close() {
            this.sliderDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.$refs.form.validate()) {
                if (this.editedIndex > -1) {
                    axios
                        .put("/api/sliders/" + this.editedItem.id, {
                            'title': this.editedItem.title,
                            'tag': this.editedItem.tag,
                        })
                        .then(res => {
                            this.sliders.splice(this.sliders.indexOf(this.selectedItem), 1, res.data)
                            this.close();
                            this.$refs.form.reset();
                            this.dataUpdateMsg = "Slider updated successfully.";
                            this.dataUpdateAlert = true;

                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                } else {

                    axios
                        .post("/api/sliders", {
                            'title': this.editedItem.title,
                            'tag': this.editedItem.tag,
                        })
                        .then(res => {
                            this.sliders.push(res.data)
                            this.close();
                            this.dataUpdateMsg = "New slider added successfully."
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
            return "storage/app/public" + selected.image
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
                .post("/api/addSliderImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.slider.splice(this.slider.indexOf(this.selected), 1, res.data)
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
        changeImage(e) {
            const file = e.target.files[0];
            this.selectedFile = e.target.files[0];

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
                .post("/api/changeSliderImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.slider.splice(this.slider.indexOf(this.selected), 1, res.data)
                })
                .catch(err => {
                    console.log(err.response);
                });

        }
    }
};
</script>
