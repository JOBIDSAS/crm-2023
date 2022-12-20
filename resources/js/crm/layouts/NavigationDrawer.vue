<template>
  <v-navigation-drawer app v-model="$store.state.drawerActive" class="navigation_drawer_container" width="200">

      <v-sheet class="navigation_drawer_header" color="white" elevation="0">
        <div class="drawer_header">
          <div class="header_user">
            <div class="user_avatar mb-1">
              <div class="avatar_img">
                <img class="avatar" src="/public/img/logo.png" alt="photo de profile">
              </div>
            </div>
            <div class="mb-2 user_info">
              <div class="info_wrapper">
                <h3 class="info_name">{{$store.state.user.data.first_name+" "+$store.state.user.data.last_name}}</h3>
                <p class="info_post">{{$store.state.user.level}} <!-- <sup>Débutant</sup> --></p>
              </div>
            </div>
            <!-- <div class="user_deball">
              <v-sheet class="p-0 m-0">
                <v-switch class="m-0 p-0" color="#111D5E" v-model="$store.state.debalActive" hide-details inset></v-switch>
              </v-sheet>
            </div> -->
          </div>
        </div>
      </v-sheet>

      <v-divider class="m-0"></v-divider>

      <v-list nav dense>
        <v-list-item-group color="#111D5E">

          <v-list-item link to="/dashboard">
              <v-list-item-icon>
                <v-icon>mdi-view-dashboard-outline</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Tableau de bord</v-list-item-title>
          </v-list-item>

          <v-list-item link to="/profile">
            <v-list-item-icon>
              <v-icon>mdi-account-circle-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Profile</v-list-item-title>
          </v-list-item>

          <!-- <v-list-item link to="/portfolio">
            <v-list-item-icon>
              <v-icon>mdi-bank-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Portefeuille</v-list-item-title>
          </v-list-item> -->

          <v-list-item link to="/test">
            <v-list-item-icon>
              <v-icon>mdi-clipboard-text-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Test d'éligibilité</v-list-item-title>
          </v-list-item>

          <v-list-group color="#111D5E" prepend-icon="mdi-account-tie-outline">

            <template v-slot:activator>
              <v-list-item-title>commercial</v-list-item-title>
            </template>

            <v-list-item-group color="#111D5E">
              
              <v-list-item link to="/calendar">
                <v-list-item-icon>
                  <v-icon>mdi-calendar-month-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Agenda</v-list-item-title>
              </v-list-item>

              <v-list-item link to="/contacts">
                <v-list-item-icon>
                  <v-icon>mdi-account-box-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Répertoire</v-list-item-title>
              </v-list-item>

              <v-list-item link to="/leads">
                <v-list-item-icon>
                  <v-icon>mdi-bullseye-arrow</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Lead contact</v-list-item-title>
              </v-list-item>

            </v-list-item-group>
          </v-list-group>

          <v-list-group color="#111D5E" prepend-icon="mdi-account-supervisor-outline">

            <template v-slot:activator>
              <v-list-item-title>Superviseur</v-list-item-title>
            </template>

            <v-list-item-group color="#111D5E">

              <v-list-item link to="/supervisor/reminder">
                <v-list-item-icon>
                  <v-icon>mdi-calendar-multiselect </v-icon>
                </v-list-item-icon>
                <v-list-item-title>Calendrier</v-list-item-title>
              </v-list-item>

              <!-- <v-list-item link to="/supervisor/teleprospector">
                <v-list-item-icon>
                  <v-icon>mdi-headset</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Téléprospecteus</v-list-item-title>
              </v-list-item> -->

              <v-list-item link to="/supervisor/client">
                <v-list-item-icon>
                  <v-icon>mdi-badge-account-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Client</v-list-item-title>
              </v-list-item>

              <!-- <v-list-item link to="/supervisor/confirmator">
                <v-list-item-icon>
                  <v-icon>mdi-alpha-c-circle-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Confirmateurs</v-list-item-title>
              </v-list-item> -->

              <!-- <v-list-item link to="/extractor">
                <v-list-item-icon>
                  <v-icon>mdi-folder-download-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Extraction</v-list-item-title>
              </v-list-item>

              <v-list-item link to="#">
                <v-list-item-icon>
                  <v-icon>mdi-bullseye</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Objectifs</v-list-item-title>
              </v-list-item>

              <v-list-item link to="#">
                <v-list-item-icon>
                  <v-icon>mdi-clipboard-text-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Deball</v-list-item-title>
              </v-list-item> -->
              
            </v-list-item-group>
          </v-list-group>



          <!-- <v-list-item link to="#">
            <v-list-item-icon>
              <v-icon>mdi-information-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>info</v-list-item-title>
          </v-list-item>

          <v-list-item link to="#">
            <v-list-item-icon>
              <v-icon>mdi-account-group-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>ressources humaines</v-list-item-title>
          </v-list-item>

          <v-list-item link to="#">
            <v-list-item-icon>
              <v-icon>mdi-archive-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Documents</v-list-item-title>
          </v-list-item>

          <v-list-item link to="#">
            <v-list-item-icon>
              <v-icon>mdi-cog-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Réglages</v-list-item-title>
          </v-list-item> -->

        </v-list-item-group>
      </v-list>

      <template v-slot:append>
        <v-sheet elevation="0" color="navigation_drawer_footer">
          <div class="drawer_footer">
            <div class="img_wrapper">
              <img class="img_src" src="/public/img/air-pod.png" alt="banner">
            </div>
          </div>
        </v-sheet>
      </template>

  </v-navigation-drawer>
</template>

<script>
export default {
  data (){
    return {
    }
  }

}
</script>

<style>

</style>