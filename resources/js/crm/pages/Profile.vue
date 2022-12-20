<template>
  <div class="profile_container">
    <template>
      <v-dialog v-model="profile.avatarDialog.isOpen" width="420px">
        <v-card>
          <v-card-title>
            <header class="m-0">Photo de profile</header>
            <v-spacer></v-spacer>
            <v-btn v-on:click="$bus.$emit('image/upload')" small outlined text color="#111D5E">Importer une image</v-btn>
          </v-card-title>
          <v-card-text class="d-flex justify-content-center p-1">
            <Cropper/>
          </v-card-text>
          <v-card-actions>
            <v-btn v-on:click="profile.avatarDialog.isOpen = false" small outlined text color="#CE1212">Fermer</v-btn>
            <v-spacer></v-spacer>
            <v-btn v-on:click="$bus.$emit('image/save')" small outlined text color="#038418">Enregistrer</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
    <div class="profile_wrapper">
      <v-row dense>
        <v-col cols="12" md="5"> 
          <v-card class="p-2">
            <v-card-title class="p-0 justify-content-center">
              <v-avatar class="avatar_holder" size="100">
                <v-img src="/public/img/logo.png"></v-img>
                <button v-on:click="profile.avatarDialog.isOpen=true" class="avatar_change"><v-icon class="change_logo">mdi-camera</v-icon></button>
              </v-avatar>
            </v-card-title>
            <v-card-text class="p-0">
              <h3 style="font-weight:800; font-size:17px" class="mt-3 text-center text-uppercase">{{$store.state.user.data.first_name+" "+$store.state.user.data.last_name}}</h3>
              <p style="font-weight:500" class="text-center mb-3">{{$store.state.user.level}}</p>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#111D5E" small dark>Ajouter</v-btn>
              <v-btn color="#111D5E" small outlined>Message</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" md="7">
          <v-card>
            <v-card-text>
              <v-row dense>
                <v-col cols="6" md="6"><h6 class="m-0">Nom complet</h6></v-col>
                <v-col cols="6" md="6"><p class="m-0">john Doe</p></v-col>
              </v-row>
              <v-divider class="my-1"></v-divider>
              <v-row dense>
                <v-col cols="6" md="6"><h6 class="m-0">Email</h6></v-col>
                <v-col cols="6" md="6"><p class="m-0">john Doe</p></v-col>
              </v-row>
              <v-divider class="my-1"></v-divider>
              <v-row dense>
                <v-col cols="6" md="6"><h6 class="m-0">Numéro de téléphone</h6></v-col>
                <v-col cols="6" md="6"><p class="m-0">john Doe</p></v-col>
              </v-row>
              <v-divider class="my-1"></v-divider>
              <v-row dense>
                <v-col cols="6" md="6"><h6 class="m-0">Adresse</h6></v-col>
                <v-col cols="6" md="6"><p class="m-0">john Doe</p></v-col>
              </v-row>
              <v-divider class="my-1"></v-divider>
              <v-row dense>
                <v-col cols="6" md="6"><h6 class="m-0">Status du compte</h6></v-col>
                <v-col cols="6" md="6"><p class="m-0">john Doe</p></v-col>
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-btn color="green" outlined small style="text-transform:none">
                Modifier
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import Cropper from "../components/Cropper";
export default {
  components:{
    Cropper,
  },
  data(){
    return {
      profile:{
        avatarDialog:{
          isOpen:false,
          isChanging:false,
        }
      }
    }
  }
}
</script>

<style>

</style>