<template>
<v-container fluid>
    <!--teams list-->
    <v-data-table :headers="headers" :items="teams.data" class="elevation-1" :footer-props="{ itemsPerPageOptions: [5, 10, 15],itemsPerPageText:'teams per page' }" :server-items-length="teams.total" :loading="loading" loading-text="Loading.....Please wait." @pagination="paginate">
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Team Management</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <!--add new project-->
                <v-dialog v-model="teamDialog" max-width="1200px" persistent>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn class="mr-2 float-right" fab dark color="success" v-bind="attrs" v-on="on">
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
                                        <v-col cols="6">
                                            <v-text-field v-model="editedItem.fname" outlined label="First name" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-text-field v-model="editedItem.lname" outlined label="Last name" dense :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="4">
                                            <v-text-field v-model="editedItem.position" outlined label="Position" dense prepend-icon="mdi-account-tie-outline" :rules="[
                                                        validRules.required
                                                    ]"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                             <v-text-field v-model="editedItem.phone" outlined label="Phone" dense prepend-icon="mdi-cellphone" :rules="[
                                                        validRules.length10,validRules.numberAll
                                                    ]"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                             <v-text-field v-model="editedItem.email" outlined label="Email" dense prepend-icon="mdi-mail" :rules="[
                                                        validRules.email
                                                    ]"></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="4">
                                            <v-text-field v-model="editedItem.fb_link" outlined label="Facebook link" dense prepend-icon="mdi-facebook"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                             <v-text-field v-model="editedItem.insta_link" outlined label="Instagram link" dense prepend-icon="mdi-instagram"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                             <v-text-field v-model="editedItem.twitter_link" outlined label="Twitter link" dense prepend-icon="mdi-twitter"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-textarea v-model="editedItem.about" outlined auto-grow label="Details of your project" :rules="[validRules.required]"></v-textarea>
                                        </v-col>
                                    </v-row>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
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

     <!--product view dialog-->
    <v-dialog max-width="600" persistent v-model="productViewDialog">
        <v-card>
            <v-btn icon @click="productViewDialog = false" class="float-right">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <p class="text-h5">Title: {{ selected.fname }}</p>
                        <p class="body-2">{{selected.lname }}</p>
                        <p class="body-2">{{selected.position }}</p>
                        <p class="body-2">{{selected.phone }}</p>
                        <p class="body-2">{{selected.email }}</p>
                        <p class="body-2">{{selected.detail }}</p>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <!--end product view dialog-->

    <!--image view button-->
    <v-dialog v-model="imageViewDialog" max-width="800px" persistent>
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
                            <v-img :src="getImage(selected)" alt="image"></v-img>
                        </div>

                        <div>
                            <div v-if="selected.image">
                                <v-btn icon outlined x-large class="mt-2" @click="onButtonClick" :loading="isSelecting">
                                    <v-icon>mdi-image-plus</v-icon>
                                </v-btn>
                                <input ref="uploader" class="d-none" type="file" accept="image/*" @change="changeImage" />
                                <p>Change image</p>
                            </div>
                            <div  v-else>
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
            teamDialog: false,
            valid: true,
            date: null,
            startDateRef: false,
            endedDateRef: false,
            validRules: {
                required: value => !!value || "Required.",
                email: v => /.+@.+\..+/.test(v) || "E-mail must be valid",
                numberAll:v => Number.isInteger(Number(v)) || "Must contain only numbers",
                length10: v =>  v && v.length == 10 || "Must be 10 characters",

            },

            //deleting
            deleteDialog: false,

            //project view
            productViewDialog:false,
            selected:'',

            //image view
            imageViewDialog:false,

             //image upload
            isSelecting: false,
            selectedFile:'',

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
                    text: "First name",
                    value: "fname"
                },
                {
                    text: "Last Name",
                    value: "lname"
                },
                {
                    text: "Position",
                    value: "position"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ],
            teams: [],
            editedIndex: -1,
            editedItem: {
                id: "",
                fname: "",
                lname: "",
                position: "",
                phone: "",
                email: "",
                fb_link:"",
                insta_link:"",
                twitter_link:"",
                about:""
            },
            defaultItem: {
                id: "",
                fname: "",
                lname: "",
                position: "",
                phone: "",
                email: "",
                fb_link:"",
                insta_link:"",
                twitter_link:"",
                about:""
            }
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Team" : "Edit Team";
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
                .post("api/myTeams?page=" + $event.page, {
                    'per_page': $event.itemsPerPage
                })
                .then(res => {
                    this.teams = res.data;
                    this.loading = false
                })
                .catch(err => console.log(err.response));
        },

        editItem(item) {
            this.editedIndex = this.teams.data.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.selectedItem = item
            this.teamDialog = true;
        },

        deleteItem(item) {
            const index = this.teams.data.indexOf(item);
            axios
                .delete("/api/teams/" + item.id)
                .then(res=>{
                        this.teams.data.splice(index,1)
                        this.deleteDialog = false
                        this.dataUpdateMsg = "Project deleted successfully"
                        this.dataUpdateAlert = true
                    })

        },

        close() {
            this.teamDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.$refs.form.validate()) {
                if (this.editedIndex > -1) {
                    axios
                        .put("/api/teams/" + this.editedItem.id, {
                            'fname': this.editedItem.fname,
                            'lname': this.editedItem.lname,
                            'position': this.editedItem.position,
                            'email': this.editedItem.email,
                            'phone': this.editedItem.phone,
                            'fb_link': this.editedItem.fb_link,
                            'insta_link': this.editedItem.insta_link,
                            'twitter_link': this.editedItem.twitter_link,
                            'about':this.editedItem.about
                        })
                        .then(res => {
                            this.teams.data.splice(this.teams.data.indexOf(this.selectedItem), 1, res.data)
                            this.close();
                            this.$refs.form.reset();
                            this.dataUpdateMsg = "Project updated successfully.";
                            this.dataUpdateAlert = true;

                        })
                        .catch(err => {
                            console.log(err.response);
                        });
                } else {

                    axios
                        .post("/api/teams", {
                            'fname': this.editedItem.fname,
                            'lname': this.editedItem.lname,
                            'position': this.editedItem.position,
                            'email': this.editedItem.email,
                            'phone': this.editedItem.phone,
                            'fb_link': this.editedItem.fb_link,
                            'insta_link': this.editedItem.insta_link,
                            'twitter_link': this.editedItem.twitter_link,
                            'about':this.editedItem.about
                        })
                        .then(res => {
                            this.teams.data.push(res.data)
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
        },
        changeStatus(item){
            this.selected=item
            this.project_status=item.status
            this.statusChangeDialog=true
        },
        changeteamstatus(){
            axios.post('api/changeteamstatus/' + this.selected.id,{
                'id':this.selected.id,
                'status':this.project_status
            }).then(res=>{
                this.teams.data.splice(this.teams.data.indexOf(this.selected),1,res.data)
                this.statusChangeDialog=false
                this.selected=''
            }).catch(err=>console.lo(err.response))
        },
        viewProject(item){
            this.selected=item
            this.productViewDialog=true
        },
        viewImage(item){
            this.selected=item
            this.imageViewDialog=true
        },
        getImage(selected){
            return "../storage/"+ selected.image
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
                .post("api/addTeamImage", data, settings)
                .then(res => {
                    this.selected = res.data
                    this.teams.data.splice(this.teams.data.indexOf(this.selected), 1, res.data)
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
        changeImage(e){
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
                .post("api/changeTeamImage", data, settings)
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
