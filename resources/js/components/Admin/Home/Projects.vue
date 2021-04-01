<template>
<v-container fluid>
    <!--projects list-->
    <v-data-table :headers="headers" :items="projects.data" class="elevation-1" :footer-props="{ itemsPerPageOptions: [5, 10, 15],itemsPerPageText:'projects per page' }" :server-items-length="projects.total" :loading="loading" loading-text="Loading.....Please wait." @pagination="paginate">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Projects Management</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <!--add new project-->
                <v-dialog v-model="projectDialog" max-width="1200px" persistent>
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
                                            <v-text-field v-model="editedItem.title" outlined label="Project Title" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="6">
                                            <v-menu ref="startDateRef" v-model="startDateRef" :close-on-content-click="false" transition="scale-transition" offset-y min-width="auto">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field v-model="editedItem.start_date" dense outlined label="Start date" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="[validRules.required]"></v-text-field>
                                                </template>
                                                <v-date-picker ref="picker" v-model="editedItem.start_date" :max="new Date().toISOString().substr(0, 10)" min="1950-01-01" @change="saveStartDate"></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-menu ref="endedDateRef" v-model="endedDateRef" :close-on-content-click="false" transition="scale-transition" offset-y min-width="auto">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field v-model="editedItem.ended_date" dense outlined label="Ended date" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="[validRules.required]"></v-text-field>
                                                </template>
                                                <v-date-picker ref="picker" v-model="editedItem.ended_date" :max="new Date().toISOString().substr(0, 10)" min="1950-01-01" @change="saveEndedDate"></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="6">
                                            <v-text-field v-model="editedItem.location" outlined label="Project Location" prepend-icon="mdi-map-marker" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-select :items="status" dense outlined prepend-icon="mdi-lan-pending" v-model="editedItem.status" item-text="title" item-value="title" :rules="[validRules.required]" label="Project status"></v-select>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-textarea v-model="editedItem.intro" label="Short introduction to project" rows="2" :rules="[validRules.required]"></v-textarea>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" align="center">
                                            <froala v-model="editedItem.detail" :tag="'textarea'" :config="config"></froala>
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
                    <v-btn icon v-on="{ ...tooltip }" @click="viewProject(item)">
                        <v-icon small class="mr-2">
                            mdi-eye
                        </v-icon>
                    </v-btn>
                </template>
                <span>View Project</span>
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
                    <v-card-text>Are you sure you want to delete this
                        Course?</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" text @click="deleteDialog = false">Cancel</v-btn>
                        <v-btn color="green darken-1" text @click="deleteItem(item)">Confirm</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <!--end delete section-->

            <!--status button-->
            <v-tooltip top>
                <template v-slot:activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip }" @click="changeStatus(item)">
                        <v-icon small class="mr-2">
                            mdi-circle-edit-outline
                        </v-icon>
                    </v-btn>
                </template>
                <span>change Status</span>
            </v-tooltip>
            <!--status button-->
        </template>
        <!--end action-->
        <template v-slot:no-data>
            <p class="text-secondary">No Data</p>
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

    <!-- status change dialog -->
    <v-dialog v-model="statusChangeDialog" max-width="400" persistent>
        <v-card>
            <v-card-title>
                Confirm Status Change
            </v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-select v-model="project_status" :rules="[validRules.required]" :items="status" label="Change Project Status" placeholder="Change Project Status" item-text="title" item-value="title" dense outlined class="mt-2 mb-n5"></v-select>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn dark rounded small class="text-capitalize" @click="statusChangeDialog = false">Cancel</v-btn>
                <v-spacer></v-spacer>
                <v-btn dark rounded small class="text-capitalize" @click="changeProjectStatus">Confirm</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- end status change dialog -->

    <!--product view dialog-->
    <v-dialog max-width="900" persistent v-model="productViewDialog">
        <v-card>
            <v-btn icon @click="productViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <div v-html="selected.detail">{{selected.detail }}</div>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <!--end product view dialog-->

    <!--image view button-->
    <v-dialog v-model="imageViewDialog" max-width="900px" persistent>
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
    data() {
        return {
            //datatable data loading
            loading: true,

            //adding form
            projectDialog: false,
            valid: true,
            date: null,
            startDateRef: false,
            endedDateRef: false,
            validRules: {
                required: value => !!value || "Required.",
            },
            detailError: '',
            status: [{
                    title: 'Finished'
                },
                {
                    title: 'Current'
                },
                {
                    title: 'Upcoming'
                },
            ],
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

            //deleting
            deleteDialog: false,

            //status change
            statusChangeDialog: false,
            project_status: '',
            selected: '',

            //project view
            productViewDialog: false,

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
                    text: "Start Date",
                    value: "start_date"
                },
                {
                    text: "Ended Date",
                    value: "ended_date"
                },
                {
                    text: "Location",
                    value: "location"
                },
                {
                    text: "Status",
                    value: "status"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ],
            projects: [],
            editedIndex: -1,
            editedItem: {
                id: "",
                title: "",
                start_date: "",
                ended_date: "",
                location: "",
                status: "",
                intro:"",
                detail: "",
            },
            defaultItem: {
                id: "",
                title: "",
                start_date: "",
                ended_date: "",
                location: "",
                intro:"",
                status: "",
                detail: "",
            }
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Project" : "Edit Project";
        },
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
        startDateRef(val) {
            val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
        },
        endedDateRef(val) {
            val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
        }
    },
    methods: {
        saveStartDate(date) {
            this.$refs.startDateRef.save(date)
        },
        saveEndedDate(date) {
            this.$refs.endedDateRef.save(date)
        },
        paginate($event) {
            axios
                .post("api/myProjects?page=" + $event.page, {
                    'per_page': $event.itemsPerPage
                })
                .then(res => {
                    this.projects = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },

        editItem(item) {
            this.editedIndex = this.projects.data.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.selectedItem = item
            this.projectDialog = true;
        },

        deleteItem(item) {
            const index = this.projects.data.indexOf(item);
            axios
                .delete("/api/projects/" + item.id)
                .then(res => {
                    this.projects.data.splice(index, 1)
                    this.deleteDialog = false
                    this.dataUpdateMsg = "Project deleted successfully"
                    this.dataUpdateAlert = true
                })

        },

        close() {
            this.projectDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.$refs.form.validate()) {
                if (this.editedItem.detail == '') {
                    this.detailError = 'No content to post.'
                } else {
                    if (this.editedIndex > -1) {
                        axios
                            .put("/api/projects/" + this.editedItem.id, {
                                'title': this.editedItem.title,
                                'start_date': this.editedItem.start_date,
                                'ended_date': this.editedItem.ended_date,
                                'location': this.editedItem.location,
                                'intro':this.editedItem.intro,
                                'status': this.editedItem.status,
                                'detail': this.editedItem.detail,
                            })
                            .then(res => {
                                this.projects.data.splice(this.projects.data.indexOf(this.selectedItem), 1, res.data)
                                this.close();
                                this.$refs.form.reset();
                                this.dataUpdateMsg = "Project updated successfully.";
                                this.dataUpdateAlert = true;

                            })
                            .catch(err => {
                                console.log(err.response);
                            });
                    } else {
                        console.log(this.editedItem.start_date)

                        axios
                            .post("/api/projects", {
                                'title': this.editedItem.title,
                                'start_date': this.editedItem.start_date,
                                'ended_date': this.editedItem.ended_date,
                                'location': this.editedItem.location,
                                'intro':this.editedItem.intro,
                                'status': this.editedItem.status,
                                'detail': this.editedItem.detail,
                            })
                            .then(res => {
                                this.projects.data.push(res.data)
                                this.close();
                                this.dataUpdateMsg = "New project added successfully."
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
        changeStatus(item) {
            this.selected = item
            this.project_status = item.status
            this.statusChangeDialog = true
        },
        changeProjectStatus() {
            axios.post('api/changeProjectStatus/' + this.selected.id, {
                'id': this.selected.id,
                'status': this.project_status
            }).then(res => {
                this.projects.data.splice(this.projects.data.indexOf(this.selected), 1, res.data)
                this.statusChangeDialog = false
                this.selected = ''
            }).catch(err => console.lo(err.response))
        },
        viewProject(item) {
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
                .post("api/addProjectImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.projects.data.splice(this.projects.data.indexOf(this.selected), 1, res.data)
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
                .post("api/changeImage", data, settings)
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
