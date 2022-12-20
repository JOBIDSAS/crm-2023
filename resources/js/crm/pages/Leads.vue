<template>
  <div class="leads_container">
    <div class="leads_wrapper">
      <template>
        <v-data-table
          :headers="leads.table.headers"
          :items="leads.table.data"
          v-model="leads.table.selected"
          :search="leads.table.search"
          value="id"
          item-key="id"
          :items-per-page="10"
          class="elevation-1"
          :single-select="false"
          show-select
          :loading="leads.table.isLoading"
          :footer-props="{
            prevIcon: 'mdi-arrow-left',
            nextIcon: 'mdi-arrow-right',
            'items-per-page-text':'Leads par page :'
          }"
          loading-text="Chargement..., veuillez patienter"
          no-data-text="Pas de données disponibles">

          <template v-slot:top>
            <v-toolbar flat height="50px">

              <template>
                <v-text-field class="ml-1"
                  v-model="leads.table.search"
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

              <v-btn v-on:click="deleted" color="#e74c3c" text small style="text-transform:none">
                Supprimer
                <v-icon small class="ml-1">mdi-delete</v-icon>
              </v-btn>

              <v-dialog v-model="leads.detailDialog.isOpen" scrollable persistent transition="dialog-bottom-transition">
                <v-card color="white" height="100%"> 

                  <v-toolbar dense flat>
                    <v-btn color="#e74c3c" icon small v-on:click="leads.detailDialog.isOpen = false">
                      <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn icon small>
                      <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                  </v-toolbar>

                  <v-container v-if="leads.detailDialog.data != null" fill-height fluid class="align-items-start">
                    <v-row dense>
                      <v-col cols="12" md="6">
                        <template>
                          <v-card flat>
                            <v-card-title class="p-0 mb-3">
                              {{leads.detailDialog.data.company.name}}
                              <v-spacer></v-spacer>
                              <v-btn v-on:click="resendMail" :disabled="leads.detailDialog.isMailSending" :loading="leads.detailDialog.isMailSending" small text color="#038418" style="text-transform:none">
                                Renvoyez mail
                                <v-icon small class="ml-1">mdi-email-send-outline</v-icon>
                              </v-btn>
                            </v-card-title>
                            <v-card-subtitle class="p-0"><span style="font-weight:700">Siret :</span> {{leads.detailDialog.data.company.siret}}</v-card-subtitle>
                            <v-card-subtitle class="p-0"><span style="font-weight:700">Naf :</span> {{leads.detailDialog.data.company.naf}}</v-card-subtitle>
                            <v-card-subtitle class="p-0"><span style="font-weight:700">Crée le :</span> {{leads.detailDialog.data.company.created}}</v-card-subtitle>
                            <v-card-text class="p-1">
                              <v-tabs color="#111D5E" v-model="leads.detailDialog.tabs" grow>
                                <v-tab style="text-transform:none">Fiche contact</v-tab>
                                <v-tab style="text-transform:none">Test d'éligibilité</v-tab>
                                <v-tab style="text-transform:none">Résultat test</v-tab>
                              </v-tabs>
                              <v-tabs-items v-model="leads.detailDialog.tabs">
                                <v-tab-item>
                                  <v-card>
                                    <v-card-text class="p-1">
                                      <v-row dense>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Nom complet :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.contact.fullname" placeholder="Nom complet"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Prénom :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.contact.firstname" placeholder="Prénom"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Nom de famille :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.contact.lastname" placeholder="Nom de famille"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Nom d'entreprise :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.name" placeholder="Nom d'entreprise"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Email :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.contact.email" placeholder="Email"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Numéro personnel :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.contact.phone" placeholder="Numéro personnel"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Numéro d'entreprise :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.phone" placeholder="numéro d'entreprise"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Région :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.address.region" placeholder="Région"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                      </v-row>
                                    </v-card-text>
                                  </v-card>
                                </v-tab-item>
                                <v-tab-item>
                                  <v-card>
                                    <v-card-text class="p-1">
                                      <v-row dense>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Statut juridique :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.status" placeholder="Statut juridique"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Secteur d'activité :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.activity" placeholder="Secteur d'activité"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Chiffre d'affaires :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.turnover" placeholder="Chiffre d'affaires"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Aides de l'état :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.statehelp" placeholder="Aides de l'état"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Chiffre d'affaires réalisé :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.lturnover" placeholder="Chiffre d'affaires réalisé"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Nombre de salariés :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.company.salaries" placeholder="Nombre de salariés"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Site internet :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.website" placeholder="Site internet"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Type de site :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.websitetype" placeholder="Type de site"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Lien de site :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.websitelink" placeholder="Lien de site"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Date de développement :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.websitedevdate" placeholder="Date de développement"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">L'agence de développement :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.agency" placeholder="L'agence de développement"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">CRM - ERP :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.crm" placeholder="CRM - ERP"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Type de crm :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.crmtype" placeholder="Type de crm"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Développement :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.crmdev" placeholder="Développement"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="12" md="12">
                                          <v-row dense no-gutters align="center">
                                            <v-col cols="6" md="6">Date de développement :</v-col>
                                            <v-col cols="6" md="6"><el-input disabled v-model="leads.detailDialog.data.development.crmdevdate" placeholder="Date de développement"></el-input></v-col>
                                          </v-row>
                                        </v-col>
                                      </v-row>
                                    </v-card-text>
                                  </v-card>
                                </v-tab-item>
                                <v-tab-item>
                                  <v-card>
                                    <v-card-text class="p-1">
                                      <v-row dense>
                                        <v-col cols="6" md="6">
                                          <h3 class="text-center">Régional</h3>
                                          <p class="text-center">{{(leads.detailDialog.data.eligibility.regional.voucher == null)?'Aide régional pas disponible':leads.detailDialog.data.eligibility.regional.voucher+" ("+leads.detailDialog.data.eligibility.regional.amount+"€ )"}}</p>
                                        </v-col>
                                        <v-col cols="6" md="6">
                                          <h3 class="text-center">CPN</h3>
                                          <p class="text-center">{{leads.detailDialog.data.eligibility.cpn}} €</p>
                                        </v-col>
                                      </v-row>
                                    </v-card-text>
                                  </v-card>
                                </v-tab-item>
                              </v-tabs-items>
                            </v-card-text>
                          </v-card>
                        </template>
                      </v-col>
                      <v-col cols="12" md="6">
                        <template>
                          <v-card flat>
                            <v-card-title class="p-0">Historiques</v-card-title>
                            <v-card-text class="p-1">
                              <v-list>
                                <v-list-item-group>
                                  <v-list-item>

                                  </v-list-item>
                                </v-list-item-group>
                              </v-list>
                            </v-card-text>
                          </v-card>
                        </template>
                      </v-col>
                    </v-row>
                  </v-container>

                  <v-container v-else fill-height fluid>
                    <v-row dense>
                      <v-col cols="12" md="12">
                        <v-skeleton-loader
                          type="article, actions"
                        ></v-skeleton-loader>
                      </v-col>
                    </v-row>
                  </v-container>

                </v-card>
              </v-dialog>

            </v-toolbar>
          </template>

          <template v-slot:[`item.confirmed`]="{ item }">
            <v-chip :color="(item.confirmed==1)?'#2ecc71':'#e74c3c'" label small dark>
              {{(item.confirmed==1)?"Terminé":"Pas terminé"}}
            </v-chip>
          </template>

          <template v-slot:[`item.calendar.confirmed`]="{ item }">
            <v-chip :color="(item.calendar.confirmed==1)?'#2ecc71':'#e74c3c'" label small dark>
              {{(item.calendar.confirmed==1)?"Oui":"Non"}}
            </v-chip>
          </template>

          <template v-slot:[`item.actions`]="{ item }">
            <v-tooltip top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on:click="leadDetail(item)" v-on="on" color="#111D5E" small text outlined>
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
import requester from "../modules/requester";
export default {
  data () {
    return {
      leads:{
        detailDialog:{
          tabs:null,
          isOpen:false,
          isLoading:false,
          isMailSending:false,
          data:{
            contact:{
              id:null,
              fullname:null,
              firstname:null,
              lastname:null,
              email:null,
              phone:null,
              region:null,
              created:null,
            },
            address:{
              region:null,
            },
            company:{
              name:null,
              phone:null,
              siret:null,
              naf:null,
              created:null,
              status:null,
              activity:null,
              turnover:null,
              statehelp:null,
              lturnover:null,
              salaries:null,
            },
            development:{
              website:null,
              websitetype:null,
              websitelink:null,
              websitedevdate:null,
              crm:null,
              crmtype:null,
              crmdev:null,
              crmdevdate:null,
              agency:null,
            },
            eligibility:{
              cpn:null,
              regional:{
                voucher:null,
                amount:null,
              }
            },
            meeting:{
              id: null,
              date: null,
              link: null,
              password: null,
            }
          },
        },
        table:{
          isLoading:true,
          search:"",
          headers: [
            { text: 'id', value: 'id' },
            { text: 'Prénom', value: 'firstname' },
            { text: 'Nom', value: 'lastname' },
            { text: 'entreprise', value: 'company.name' },
            { text: 'Téléphone', value: 'phone' },
            { text: 'Email', value: 'email' },
            { text: 'Test', value: 'confirmed' },
            { text: 'Confirmer', value: 'calendar.confirmed' },
            { text: 'Actions', value: 'actions', sortable:false },
          ],
          selected:[],
          data:[],
        }
      }
    }
  },
  created:function(){
    this.getLeads();
  },
  methods:{
    deleted(){
      console.log(this.leads.table.selected)
    },

    getLeads(){
      requester.getContactsLeads()
      .then(response=>{
        this.leads.table.isLoading = false;
        response.data.leads.forEach(lead => {
          this.leads.table.data.push(lead)
        });
      })
      .catch(error=>console.log(error)); 
    },

    leadDetail(data){
      this.leads.detailDialog.isOpen = true;
      this.leads.detailDialog.data = {
        contact:{
          id: data.id,
          fullname: data.firstname+" "+data.lastname,
          firstname: data.firstname,
          lastname: data.lastname,
          email: data.email,
          phone: data.phone,
          created: data.created,
        },
        address:{
          region: data.address.region,
        },
        company:{
          name: data.company.name,
          phone: data.company.phone,
          siret: data.company.siret,
          naf: data.company.naf,
          created: data.company.created,
          status: data.company.status,
          activity: data.company.activity,
          turnover: data.company.turnover,
          statehelp: data.company.statehelp,
          lturnover: "entre "+data.company.lturnover.min+"€ et "+data.company.lturnover.max+"€",
          salaries: data.company.salaries,
        },
        development:{
          website: data.development.website,
          websitetype: data.development.websitetype,
          websitelink: data.development.websitelink,
          websitedevdate: data.development.websitedevdate,
          crm: data.development.crm,
          crmtype: data.development.crmtype,
          crmdev: data.development.crmdev,
          crmdevdate: data.development.crmdevdate,
          agency: data.development.agency,
        },
        eligibility:{
          cpn: data.eligibility.cpn,
          regional:{
            voucher: data.eligibility.regional.voucher,
            amount: data.eligibility.regional.amount,
          }
        },
        meeting:{
          id: data.meeting.zid,
          date: data.meeting.date,
          link: data.meeting.link,
          password: data.meeting.password,
        }
      };
    },

    resendMail(){
      this.leads.detailDialog.isMailSending = true
      requester.rensendConfirmationMail(JSON.stringify(this.leads.detailDialog.data))
      .then(response => {
        if(response.data.error){
          this.$notify({
            title: "Email confirmation",
            message: response.data.message,
            type: 'error'
          });
          this.leads.detailDialog.isMailSending = false
        } else {
          this.$notify({
            title: "Email confirmation",
            message: response.data.message,
            type: 'success'
          });
          this.leads.detailDialog.isMailSending = false
        }
      })
      .catch(error => {
        this.leads.detailDialog.isMailSending = false
        console.log(error)
      })
    }
  }
}
</script>