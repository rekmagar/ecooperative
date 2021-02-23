<template>
  <v-app>
    <v-container>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <!-- <div class="card-header">
                <h3>Fiscal Year</h3>
                  item-key=""
                  :sort-by=""
                </div> -->
              <div class="card-body">
                <v-data-table
                    class="elevation-1"
                    :loading="loading"
                    loading-text="Loading... Please wait"                          
                    :headers="headers"
                    :items="recData"
                  >
                  
                    <template v-slot:top>
                      <v-toolbar
                        flat
                        color="blue-grey darken-3"
                      >
                        <v-toolbar-title><span class="white--text">आर्थिक वर्ष</span></v-toolbar-title>
                        <v-divider
                          class="mx-4"
                          inset
                          vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-dialog
                          v-model="dialog"
                          max-width="500px"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-btn
                              color="primary"
                              dark
                              class="mb-2"
                              v-bind="attrs"
                              v-on="on"
                            >
                              नयाँ रेकर्ड
                            </v-btn>
                          </template>
                          <v-card>
                            <v-app-bar
                              dense
                              dark
                              color="blue-grey darken-3"
                            >
                              <v-toolbar-title><span class="headline">{{ formTitle }}</span></v-toolbar-title>
                            </v-app-bar>
    
                            <v-card-text>
                              <v-container>
                                <v-row>
                                  <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                                    margin-top="16"
                                  >
                                    <v-text-field
                                      v-model="editedItem.fyear"
                                      label="आर्थिक वर्ष"
                                      outlined
                                      hide-details
                                      v-mask="'####/###'"
                                    ></v-text-field>
                                  </v-col>
                                  <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"                                          
                                  >
                                    <v-text-field
                                      v-model="editedItem.begdate"
                                      label="शुरु मिति"
                                      hide-details
                                      outlined
                                      v-mask="'####/##/##'"
                                    ></v-text-field>
                                  </v-col>                                        
                                  <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                                  >
                                    <v-text-field
                                      v-model="editedItem.enddate"
                                      label="अन्तिम मिति"
                                      hide-details
                                      outlined
                                      v-mask="'####/##/##'"
                                    ></v-text-field>
                                  </v-col>
                                  <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                                  >
                                    <v-text-field
                                      v-model="editedItem.remarks"
                                      label="कैफियत"
                                      hide-details
                                      outlined
                                    ></v-text-field>
                                  </v-col>
                                </v-row>
                              </v-container>
                            </v-card-text>

                            <v-app-bar
                              dense
                              dark
                              color="blue-grey darken-3"
                            >
                              
                                <v-spacer></v-spacer>
                                <v-card-actions>
                                  <v-spacer></v-spacer>
                                  <v-btn                                    
                                    text
                                    @click="close"
                                  >
                                    रद्द गर्नुहोस्
                                  </v-btn>
                                  <v-btn
                                    text
                                    @click="save"
                                  >
                                    सुनिश्चित गर्नुहोस्
                                  </v-btn>
                                </v-card-actions>
                              
                            </v-app-bar>

                            
                          </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                          <v-card>
                            <v-card-title class="headline">तपाँई साच्चै यो विवरण हटाउन चाहनुहुन्छ?</v-card-title>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="closeDelete">रद्द गर्नुहोस्</v-btn>
                              <v-btn color="blue darken-1" text @click="deleteItemConfirm">निश्चित गर्नुहोस्</v-btn>
                              <v-spacer></v-spacer>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-toolbar>
                    </template>

                    <template v-slot:item.actions="{ item }">
                      <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                      >
                        mdi-pencil                                
                      </v-icon>
                      <v-icon
                        small
                        @click="deleteItem(item)"
                      >
                        mdi-delete                                
                      </v-icon>
                    </template>

                    <template v-slot:no-data>
                      <v-btn
                        color="primary"
                        @click="initialize"
                      >
                        Reset
                      </v-btn>
                    </template>
                </v-data-table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </v-app>
</template>
<script>
import axios from 'axios'
  export default {
    data: () => ({
      loading: false,
      dialog: false,
      dialogDelete: false,
      recData: [ ],
      headers: [
        {
          text: '#',
          align: 'start',
          sortable: true,
          value: 'id',
        },
        { text: 'आर्थिक वर्ष', value: 'fyear' },
        { text: 'शुरु मिति', value: 'begdate' },
        { text: 'अन्तिम मिति', value: 'enddate' },
        { text: 'कैफियत', value: 'remarks' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      recData: [],
      editedIndex: -1,
      editedItem: {
        recid: 0,
        fyear: '',
        begdate: '',
        enddate: '',
        remarks: '',
        llcode: '134',
        cmpcode: '1',
        tmpUser: 'Rek',
        tmpDate: '2077-10-19',
        tmpTime: '05:30',
      },
      defaultItem: {
        recid: 0,
        fyear: '',
        begdate: '',
        enddate: '',
        remarks: '',
        llcode: '134',
        cmpcode: '1',
        tmpUser: 'Rek',
        tmpDate: '2077-10-19',
        tmpTime: '05:30',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'नयाँ आ.व.' : 'आ.व. सच्याउने'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        // Add a request interceptor
        axios.interceptors.request.use((config) => {          
            this.loading = true;
            return config;
        }, (error) => {
            this.loading = false;
            return Promise.reject(error);
        });
        // Add a response interceptor
        axios.interceptors.response.use((response) => {          
            this.loading = false;
            return response;
        }, (error) => {      
            this.loading = false;    
            return Promise.reject(error);
        });
        axios.get('/api/fyear', {})
        .then(res => {          
          this.recData=res.data.fyear;          
          // console.dir(recData[0]);
          // console.dir(res.data.fyear);
        })
        .catch(err => {
          console.dir(err);
          if(err.response == 401)
            localStorage.removeItem('token');
            this.$router.push('/login');
        })
      },

      editItem (item) {
        this.editedIndex = this.recData.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        // this.editedIndex = this.recData.indexOf(item)
        // this.editedItem = Object.assign({}, item)
        // this.dialogDelete = true
        const index = this.recData.indexOf(item)
        let decide = confirm('Are you sure to delete this item?')
        if(decide){
             axios.delete('/api/fyear/'+item.id)
            .then(res => {
                // this.text = "Record Deleted Successfully!";
                // this.snackbar = true
                this.recData.splice(index, 1)
            }).catch(err => {
              console.log(err.response)
              // this.text = "Error Deleting Record"
              // this.snackbar=true
            })
        }
      },

      deleteItemConfirm () {
        this.recData.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
      save () {
        if (this.editedIndex > -1) {
          const index = this.editedIndex;
          // console.log(this.editedItem);                    
          axios.put('api/fyear/'+this.editedItem.recid, 
          {
            'recid': this.editedItem.recid,
            'fyear': this.editedItem.fyear,
            'begdate': this.editedItem.begdate,
            'enddate': this.editedItem.enddate,
            'remarks': this.editedItem.remarks,
            'llcode': this.editedItem.llcode,
            'cmpcode': this.editedItem.cmpcode,
            'tmpUser': this.editedItem.tmpUser,
            'tmpDate': this.editedItem.tmpDate,
            'tmpTime': this.editedItem.tmpTime,
            })
          .then(res =>{
              // this.text = "Record Updated Successfully!";
              // this.snackbar = true;
              // Object.assign(this.roles.data[index], res.data.role)
              Object.assign(this.recData.data[index], res.recData)
          })
          .catch(err =>{
            console.log(err.response)
            // this.text = "Error Updating Record"
            // this.snackbar=true
          });          
        } else {
          axios.post('/api/fyear', 
            {
              'fyear': this.editedItem.fyear,
              'begdate': this.editedItem.begdate,
              'enddate': this.editedItem.enddate,
              'remarks': this.editedItem.remarks,
              'llcode': this.editedItem.llcode,
              'cmpcode': this.editedItem.cmpcode,
              'tmpUser': this.editedItem.tmpUser,
              'tmpDate': this.editedItem.tmpDate,
              'tmpTime': this.editedItem.tmpTime,
              })
          .then(res =>{
            // console.dir(res.fyear);
            this.recData.push(res.data.fyear);
            // this.recData.push(this.editedItem);
            // this.roles.data.push(res.data.role)
          })
          
          .catch(err => console.dir(err.response));          
        }
        this.close()
        
      },
    },
  }
</script>