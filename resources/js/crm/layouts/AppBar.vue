<template>
  <v-app-bar app dense flat class="app_bar_container">
    <v-app-bar-nav-icon v-on:click="$store.state.drawerActive =! $store.state.drawerActive"></v-app-bar-nav-icon>
    <v-spacer></v-spacer>
    <v-btn icon link to="/signout">
      <v-icon color="#e74c3c">mdi-logout-variant</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {

}
</script>

<style>

</style>