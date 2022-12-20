<template>
  <div class="contact_container">
    <div class="contact_wrapper">
      <template>
        <v-data-table
          :headers="contact.table.headers"
          :items="contact.table.data"
          :search="contact.table.search"
          item-key="name"
          :items-per-page="10"
          class="elevation-1"
          :single-select="false"
          :show-select="true"
          :loading="false"
          :footer-props="{
            prevIcon: 'mdi-arrow-left',
            nextIcon: 'mdi-arrow-right',
            'items-per-page-text':'Contacts par page :'
          }"
          loading-text="Chargement..., veuillez patienter"
          no-results-text="Aucun enregistrements correspondants trouvés"
          no-data-text="Pas de données disponibles">

          <!--Header table-->

          <template v-slot:top>
            <v-toolbar flat height="50px">
              <!--search table-->
              <template>
                <v-text-field class="ml-1"
                  v-model="contact.table.search"
                  prepend-inner-icon="mdi-magnify"
                  label="Recherche..."
                  single-line
                  hide-details
                  dense
                  flat
                  solo
                  color="#111D5E">
                </v-text-field>
              </template>
  
              <v-spacer></v-spacer>

              <!--filter data table-->
              <!-- <v-dialog v-model="contact.dialog.isFilterOpen" width="500">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="#111D5E" dark small v-bind="attrs" v-on="on">
                    Filtrer<v-icon class="ml-1" small>mdi-filter</v-icon>
                  </v-btn>
                </template>
                <template>
                  <v-card>
                    <v-card-title>
                      <header class="m-0">Filtre liste contacts</header>
                    </v-card-title>
                    <v-card-text>
                      <v-row>
                        <v-col cols="12">
                          <MapFrench/>
                        </v-col>
                      </v-row>
                    </v-card-text>
                    <v-card-actions>
                      <v-btn color="#CE1212" small outlined text v-on:click="contact.dialog.isFilterOpen=false" >Fermer</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn color="#038418" small outlined text :loading="contact.dialog.isAdding" :disabled="contact.dialog.isFiltring" v-on:click="addContactData">Filtre</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog> -->

              <!--add data table-->
              <v-dialog v-model="contact.addDialog.isOpen" width="500">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn  class="ml-4" color="#111D5E" dark small v-bind="attrs" v-on="on">
                    Ajouter<v-icon class="ml-1" small>mdi-plus</v-icon>
                  </v-btn>
                </template>
                <template>
                  <v-card>
                    <v-card-title>
                      <header class="m-0">Ajouter un nouveau contact</header>
                    </v-card-title>
                    <v-card-text>
                      <v-row dense>
                        <v-col cols="12">
                          <el-input v-model="contact.addDialog.formData.zipcode" placeholder="Code postal"></el-input>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                          <el-input v-model="contact.addDialog.formData.firstname" placeholder="Prénom"></el-input>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                          <el-input v-model="contact.addDialog.formData.lastname" placeholder="Nom de famille"></el-input>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                          <el-input v-model="contact.addDialog.formData.phone" placeholder="Numéro de téléphone"></el-input>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                          <el-input v-model="contact.addDialog.formData.email" placeholder="Email"></el-input>
                        </v-col>
                        <!-- <v-col cols="12">
                          <v-select
                            v-model="contact.addDialog.formData.status.label"
                            :items="['NRP','entreprise fermé','Pas intérésser','Test pas terminer','A rappeler','Doublon']"
                            placeholder="Status"
                            height="20px"
                            dense
                            outlined
                            color="#111D5E"
                            :hide-details="true">
                          </v-select>
                        </v-col> -->
                      </v-row>
                    </v-card-text>
                    <v-card-actions>
                      <v-btn color="#CE1212" small outlined text v-on:click="contact.addDialog.isOpen=false" >Fermer</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn color="#038418" small outlined text :loading="contact.addDialog.isAdding" :disabled="contact.addDialog.isAdding" v-on:click="addContactData">Ajouter</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>

              <!--edit data table-->
              <!-- <v-dialog v-model="contact.dialog.isDetailOpen" width="500">
                <template>
                  <v-card>
                    <v-card-title>
                      <header class="m-0">Détail contact</header>
                    </v-card-title>
                    <v-card-text>
                      <v-row>
                        <v-col cols="12">
                          as
                        </v-col>
                      </v-row>
                    </v-card-text>
                    <v-card-actions>
                      <v-btn color="#CE1212" small outlined text v-on:click="contact.dialog.isDetailOpen=false" >Fermer</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn color="#038418" small outlined text :loading="contact.dialog.isDetailing" :disabled="contact.dialog.isDetailing" v-on:click="addContactData">Filtre</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog> -->

            </v-toolbar>
          </template>

          <!--Header table-->

          <template v-slot:[`item.status`]="{ item }">
            <v-chip :color="item.status.color" label small dark>
              {{ item.status.label }}
            </v-chip>
          </template>

          <template v-slot:[`item.actions`]="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn @click="editContactData(item)" color="#111D5E" v-bind="attrs" v-on="on" small text outlined>
                  <v-icon small>mdi-eye</v-icon>
                </v-btn>
              </template>
              <span>Détails</span>
            </v-tooltip>
          </template>

        </v-data-table>
      </template>
    </div>
  </div>
</template>

<script>
  import MapFrench from "../components/MapFrench";
  export default {
    components:{
      MapFrench,
    },
    data () {
      return {
        contact:{
          detailDialog:{
            isOpen:false,
            isLoading:false,
          },
          addDialog:{
            isOpen:false,
            isAdding:false,
            formData:{
              zipcode:"",
              firstname:"",
              lastname:"",
              phone:"",
              email:"",
              status:{label:"En attente", color:"blue"},
            },
          },
          listData:[],
          table:{
            search:"",
            headers: [
              { text: 'CP', value: 'zipcode' },
              { text: 'Prénom', value: 'firstname' },
              { text: 'Nom', value: 'lastname' },
              { text: 'Téléphone', value: 'phone' },
              { text: 'Email', value: 'email' },
              { text: 'Status', value: 'status' },
              { text: 'Actions', value: 'actions', sortable:false },
            ],
            data:[
              /* {
                zipcode: 95270,
                firstname: "khalil ben macha",
                lastname: "khalil ben macha",
                phone: 672929146,
                email: "klilmecha@gmail.com",
                status: {label:"En attente", color:"blue"},
              }, */
            ],
          }
        }
      }
    },
    methods:{
      addContactData(){
        this.contact.addDialog.isAdding = true;
        this.contact.table.data.push({
          zipcode: this.contact.addDialog.formData.zipcode,
          firstname: this.contact.addDialog.formData.firstname,
          lastname: this.contact.addDialog.formData.lastname,
          phone: this.contact.addDialog.formData.phone,
          email: this.contact.addDialog.formData.email,
          status:{
            label: "En attente", 
            color: "blue"
          }
        });

        this.contact.addDialog.isOpen = false;
        this.contact.addDialog.isAdding = false;

        this.contact.addDialog.formData.zipcode = "";
        this.contact.addDialog.formData.firstname = "";
        this.contact.addDialog.formData.lastname = "";
        this.contact.addDialog.formData.phone = "";
        this.contact.addDialog.formData.email = "";
        this.contact.addDialog.formData.status.label = "";
        this.contact.addDialog.formData.status.color = "";
      },
      /* editContactData(item){
        this.contact.dialog.isDetailOpen = true
      } */
      
    }
  }
</script>