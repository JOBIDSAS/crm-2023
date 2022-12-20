<template>
  <v-app role="main" data-app id="main" class="app_container">

    <NavigationDrawer v-if="$store.state.user.logged"/>
    <AppBar v-if="$store.state.user.logged"/>

    <v-main class="main_container">
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <!-- <v-footer app class="footer_container">
    </v-footer> -->
  </v-app>
</template>

<script>
import NavigationDrawer from "./layouts/NavigationDrawer";
import AppBar from "./layouts/AppBar";
import requester from './modules/requester';
export default {
  components:{
    NavigationDrawer,
    AppBar,
  },
  data(){
    return {
      drawer:true,
    }
  },
  beforeCreate:function(){
    if(localStorage.getItem("token")){
      requester.signData()
      .then(response=>{
        this.$store.commit("userInfo",{
            logged:true,
            userData:response.data.user,
            userlevel:response.data.level,
          });
      })
      .catch(error=>console.log(error));
    }
  },
}
</script>

<style>

</style>