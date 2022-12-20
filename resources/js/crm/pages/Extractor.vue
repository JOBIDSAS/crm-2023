<template>
  <div class="extractor_container">
    <div class="extractor_wrapper">
      <template>
        <v-data-table
          :headers="extractions.table.headers"
          :items="extractions.table.data"
          :search="extractions.table.search"
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

          <template v-slot:top>
            <v-toolbar flat height="50px">
              <v-dialog v-model="extractions.importDialog.isOpen" width="500">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn  class="ml-4" color="#111D5E" text small v-bind="attrs" v-on="on">
                    Importer<v-icon class="ml-1" small>mdi-upload</v-icon>
                  </v-btn>
                </template>
                <template>
                  <v-card>
                    <v-card-title>
                      <header class="m-0">Importer liste clients</header>
                    </v-card-title>
                    <v-card-text>
                      <el-upload
                        drag
                        :on-preview="handlePreview"
                        :on-remove="handleRemove"
                        :file-list="extractions.importDialog.fileList"
                        multiple>
                        <i class="el-icon-upload"></i>
                        <div class="el-upload__text">Déposer les fichiers ici ou<em>cliquez pour envoyer</em></div>
                        <div class="el-upload__tip" slot="tip">Fichiers excel avec une taille inférieure à 5mb</div>
                      </el-upload>
                      <!-- <v-sheet class="p-2" rounded="rounded" color="#d8d7db">
                        <v-row dense no-gutters justify="center">
                        <v-col class="d-flex justify-content-center" cols="12" md="12" sm="12">
                          <v-icon size="60">mdi-cloud-upload</v-icon>
                        </v-col>
                        <v-col class="d-flex justify-content-center" cols="12" md="12" sm="12">
                          Glisser ici pour importer un fichier
                        </v-col>
                        <v-col class="d-flex justify-content-center" cols="12" md="12" sm="12">
                          <input accept=".csv" @change="importContactData" style="border:none;outline:none;background:transparent" type="file" placeholder="clicker ici pour importer un fichier">
                        </v-col>
                      </v-row>
                      </v-sheet> -->
                    </v-card-text>
                    <v-card-actions>
                      <v-btn color="#CE1212" small outlined text v-on:click="extractions.importDialog.isOpen=false" >Fermer</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn color="#038418" small outlined text :loading="extractions.importDialog.isImporting" :disabled="extractions.importDialog.isImporting" v-on:click="importContactData">Ajouter</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-toolbar>
          </template>

          <template v-slot:[`item.actions`]="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn @click="showData(item)" color="#111D5E" v-bind="attrs" v-on="on" small text outlined>
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
export default {
    data () {
      return {
        extractions:{
          importDialog:{
            isOpen:false,
            isImporting:false,
            fileList:[],
          },
          formData:{},
          listData:[],
          table:{
            search:"",
            headers: [
              { text: 'CP', value: 'zipcode' },
              { text: 'Région', value: 'region' },
              { text: 'Nom', value: 'name' },
              { text: 'Téléphone', value: 'phone' },
              { text: 'Email', value: 'email' },
              { text: 'Actions', value: 'actions', sortable:false, },
            ],
            data:[],
          }
        }
      }
    },
    methods:{
      showData(item){
        console.log(item)
      },
      /* handlePreview(){

      },
      handleRemove(){

      }, */
      importContactData(file){
        this.handleCsvFile(file.target.files[0]);
      },
      handleCsvFile(file){
        if(window.FileReader){
          if(file!=null)this.getAsText(file)
        } else {
          console.log("Lecteur de fichiers non pris en charge dans ce navigateur")
        }
      },
      getAsText(file){
        console.log(file)
        let reader = new FileReader();
        reader.readAsText(file);
        reader.onload = this.loadCsvHandler;
        reader.onerror = this.errorCsvHandler;
      },
      loadCsvHandler(data){
        let csv = data.target.result;
        let textLines = csv.split(/\r\n|\n/);
        
        for (let index = 1; index < textLines.length; index++) {
          const row = textLines[index].split(',');
          console.log(row)
          console.log(row);
          let col = [];
          for (let index = 0; index < row.length; index++) {
            col.push(row[index]);
          }
          //this.contact.listData.push(col);
          this.extractions.table.data.push({
            zipcode: col[1],
            name: col[3],
            phone: col[5],
            email: col[7],
          })
        }
      },
      errorCsvHandler(){

      }
    }
  }
</script>

<style>

</style>