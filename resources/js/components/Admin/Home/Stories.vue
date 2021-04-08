<template>
<v-container fluid>
    <!--stories list-->

    <v-data-table :headers="headers" :items="stories.data" class="elevation-1" :footer-props="{ itemsPerPageOptions: [5, 10, 15],itemsPerPageText:'stories per page' }" :server-items-length="stories.total" :loading="loading" loading-text="Loading.....Please wait." @pagination="paginate" item-key="id">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Story Management</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <!--add new story-->
                <v-dialog v-model="storyDialog" max-width="1200px" persistent>
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
                                            <v-text-field v-model="editedItem.title" outlined label="Blog title" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.author" outlined label="Blog author" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row class="mt-n5">
                                        <v-col cols="12" align="center">
                                            <froala v-model="editedItem.detail"  :tag="'textarea'" :config="config"></froala>
                                            <div style="color:red">{{detailError}}</div>
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
            <!--product view button-->
            <v-tooltip top>
                <template v-slot:activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip }" @click="viewstory(item)">
                        <v-icon small class="mr-2">
                            mdi-eye
                        </v-icon>
                    </v-btn>
                </template>
                <span>View story</span>
            </v-tooltip>

            <!--end view button-->

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
                    <v-card-text>Are you sure you want to delete this blog?</v-card-text>
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
            <p class="text-secondary">No Blogs</p>
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

    <!--product view dialog-->
    <v-dialog max-width="900" persistent v-model="productViewDialog">
        <v-card>
            <v-btn icon @click="productViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <div v-html="selected.detail"></div>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <!--end product view dialog-->

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
import VueFroala from 'vue-froala-wysiwyg';
export default {
    components: {

    },
    data() {
        return {
            //datatable data loading
            loading: true,

            //adding form
            storyDialog: false,
            valid: true,
            validRules: {
                required: value => !!value || "Required.",
            },
            detailError:'',
            config: {
                language: "en", // localization
                placeholderText: "Share what you've g",
                zIndex: 2501,
                charCounterMax: 5000,
                toolbarSticky: false,
                quickInsertEnabled: false,
                heightMin: 200,

                toolbarButtons: {
                    // name for block of buttons

                    moreParagraph: {
                        buttons: [
                            "paragraphFormat",
                            "formatOLSimple",
                            "formatUL",
                            "alignLeft",
                            "alignCenter",
                            "alignRight",
                            "alignJustify",
                        ],
                        align: "left",
                        buttonsVisible: 7
                    },
                    moreText: {
                        // buttons you need on this block
                        buttons: [
                            "bold",
                            "italic",
                            "underline",
                            "textColor",
                            "inlineClass",
                            "backgroundColor",
                        ],
                        align: "left",
                        buttonsVisible: 7
                    },
                    moreRich: {
                        buttons: [
                            "insertLink",
                        ],
                        align: "left",
                        buttonsVisible: 1
                    },
                },
               
            },

            model: "Edit Your Content Here!",

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
                    text: "Author",
                    value: "author"
                },
                {
                    text: "Created Date",
                    value: "created_at"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ],
            stories: [],
            editedIndex: -1,
            editedItem: {
                id: "",
                title: "",
                author:"",
                created_date: "",
                detail: "",
            },
            defaultItem: {
                id: "",
                title: "",
                author:"",
                created_date: "",
                detail: "",
            }
        };
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Blog" : "Edit Blog";
        },
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
    },
    methods: {
        paginate($event) {
            axios
                .post("api/myStories?page=" + $event.page, {
                    'per_page': $event.itemsPerPage
                })
                .then(res => {
                    this.stories = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },

        editItem(item) {
            this.editedIndex = this.stories.data.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.selectedItem = item
            this.storyDialog = true;
        },

        deleteItem(item) {
            const index = this.stories.data.indexOf(item);
            axios
                .delete("/api/stories/" + item.id)
                .then(res => {
                    this.stories.data.splice(index, 1)
                    this.deleteDialog = false
                    this.dataUpdateMsg = "Story deleted successfully"
                    this.dataUpdateAlert = true
                })
        },

        close() {
            this.storyDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.$refs.form.validate()) {
                if(this.editedItem.detail==''){
                    this.detailError='No content to post'
                }else{
                    if (this.editedIndex > -1) {
                    axios
                        .put("/api/stories/" + this.editedItem.id, {
                            'title': this.editedItem.title,
                            'author':this.editedItem.author,
                            'detail': this.editedItem.detail,
                            'created_at': new Date()
                        })
                        .then(res => {
                            this.stories.data.splice(this.stories.data.indexOf(this.selectedItem), 1, res.data)
                            this.close();
                            this.$refs.form.reset();
                            this.dataUpdateMsg = "Story updated successfully.";
                            this.dataUpdateAlert = true;

                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                } else {

                    axios
                        .post("/api/stories", {
                            'title': this.editedItem.title,
                            'author':this.editedItem.author,
                            'detail': this.editedItem.detail,
                            'created_at': new Date()
                        })
                        .then(res => {
                            this.stories.data.push(res.data)
                            this.close();
                            this.dataUpdateMsg = "New story added successfully."
                            this.dataUpdateAlert = true
                            this.$refs.form.reset()
                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                }
                }
                
            }
        },

        viewstory(item) {
            this.selected = item
            this.productViewDialog = true
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
                .post("api/addStoryImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.stories.data.splice(this.stories.data.indexOf(this.selected), 1, res.data)
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
                .post("api/changeStoryImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.stories.data.splice(this.stories.data.indexOf(this.selected), 1, res.data)
                })
                .catch(err => {
                    console.log(err.response);
                });

        }
    }
};
</script>
