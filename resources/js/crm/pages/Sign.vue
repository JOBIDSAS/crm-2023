<template>
  <div class="sign_container">
    <div class="sign_wrapper">
      <form autocomplete="off" v-on:submit.prevent ref="signIn" action="#" class="form_content">
        <template v-if="sign.active.signIn">
          <v-card elevation="5" width="450">
            <v-card-text>
              <v-row justify="center">
                <v-col cols="auto">
                  <h5 class="m-0 text-center">Bienvenue</h5>
                  <p class="m-0 text-center">Veuillez s'identifier pour continuer</p>
                </v-col>
              </v-row>
              <v-row dense>
                <v-col cols="12" md="12">
                  <el-input type="email" placeholder="Adresse mail" v-model="sign.formData.email"></el-input>
                </v-col>
                <v-col cols="12" md="12">
                  <el-input type="password" placeholder="Mot de passe" v-model="sign.formData.password"></el-input>
                </v-col>
              </v-row>
              <v-row justify="center" dense>
                <v-col cols="4" md="4">
                  <v-btn v-on:click="signIn" :loading="sign.active.signInLoading" :disabled="sign.active.signInLoading" outlined small color="#038418">
                    Se connecter<v-icon class="ml-1" small>mdi-login-variant</v-icon>
                    <template v-slot:loader>
                      <span class="custom_loader">
                        <v-icon light>mdi-cached</v-icon>
                      </span>
                    </template>
                  </v-btn>
                </v-col>
              </v-row>
              <v-divider></v-divider>
              <v-row justify="center" dense>
                <v-col cols="auto">
                  <v-btn color="#111D5E" small plain text>Mot de passe oublié</v-btn>
                </v-col>
              </v-row>
              <v-row justify="center" dense>
                <v-col cols="auto">
                  <p class="m-0">Vous n'avez pas un compte ?<v-btn v-on:click="sign.active.signIn = false" color="#111D5E" small plain text>S'identifier</v-btn></p>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </template>
        <template v-else>
          <v-card elevation="5" width="450">
            <v-card-text>
              <v-row justify="center">
                <v-col cols="auto">
                  <h5 class="m-0 text-center">Bienvenue</h5>
                  <p class="m-0 text-center">Veuillez Créer un compte !</p>
                </v-col>
              </v-row>
              <v-row dense>
                <v-col cols="12" md="6">
                  <el-input type="text" placeholder="Prénom" v-model="sign.formData.firstname"></el-input>
                </v-col>
                <v-col cols="12" md="6">
                  <el-input type="text" placeholder="Nom de famille" v-model="sign.formData.lastname"></el-input>
                </v-col>
              </v-row>
              <v-row dense>
                <v-col cols="12" md="12">
                  <el-input type="email" placeholder="Adresse mail" v-model="sign.formData.email"></el-input>
                </v-col>
                <v-col cols="12" md="12">
                  <el-input type="password" placeholder="Mot de passe" v-model="sign.formData.password"></el-input>
                </v-col>
              </v-row>
              <v-row dense>
                <v-col cols="12" md="6" class="d-flex justify-content-center">
                  <el-radio v-model="sign.formData.level" :label="3" name="level">Conseiller</el-radio>
                </v-col>
                <v-col cols="12" md="6" class="d-flex justify-content-center">
                  <el-radio disabled v-model="sign.formData.level" :label="4" name="level">Confirmateur</el-radio>
                </v-col>
              </v-row>
              <v-row justify="center" dense>
                <v-col cols="4" md="4">
                  <v-btn v-on:click="signUp" :loading="sign.active.signUpLoading" :disabled="sign.active.signUpLoading" outlined small color="#038418">
                    S'dentifier<v-icon class="ml-1" small>mdi-login-variant</v-icon>
                    <template v-slot:loader>
                      <span class="custom_loader">
                        <v-icon light>mdi-cached</v-icon>
                      </span>
                    </template>
                  </v-btn>
                </v-col>
              </v-row>
              <v-divider></v-divider>
              <v-row justify="center" dense>
                <v-col cols="auto">
                  <p class="m-0">Vous avez un compte ?<v-btn v-on:click="sign.active.signIn = true" color="#111D5E" small plain text>Se connecter</v-btn></p>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </template>
      </form>
    </div>
  </div>
</template>

<script>
import requester from "../modules/requester";
export default {
  data () {
    return {
      sign:{
        active:{
          signIn:true,
          signInLoading:false,
          signUpLoading:false,
        },
        formData:{
          firstname:null,
          lastname:null,
          email:"",
          password:"",
          level:3,
        }
      },
    }
  },
  methods:{
    async signIn(){
      let formData = this.sign.formData;
      if(formData.email == null || formData.email.trim() == "") return this.$notify({
        title: 'Email',
        message: 'Adresse email est requise',
        type: 'error'
      });
      if(formData.password == null || formData.password.trim() == "") return this.$notify({
        title: 'Mot de passe',
        message: 'Mot de passe requis',
        type: 'error'
      });
      this.sign.active.signInLoading = true;
      requester.signIn(JSON.stringify(formData))
      .then(response=>{
        if(response.data.error){
          this.$notify({
            title: 'Connexion',
            message: response.data.message,
            type: 'error'
          });
        } else {
          this.$notify({
            title: 'Connexion',
            message: response.data.message,
            type: 'success'
          });
          localStorage.setItem("token",response.data.token)
          this.$store.commit("userInfo",{
            logged:true,
            userData:response.data.user,
            userlevel:response.data.level,
          });
          this.$router.push('/dashboard');
        }
        this.sign.active.signInLoading = false;
      })
      .catch(error=>{
        console.log(error);
        this.sign.active.signInLoading = false;
      });
    },
    async signUp(){
      let formData = this.sign.formData;
      if(formData.lastname == null || formData.lastname.trim() == "") return this.$notify({
        title: 'Nom de famille',
        message: 'Nom de famille est requis',
        type: 'error'
      });
      if(formData.firstname == null || formData.firstname.trim() == "") return this.$notify({
        title: 'Prénom',
        message: 'Prénom est requis',
        type: 'error'
      });
      if(formData.email == null || formData.email.trim() == "") return this.$notify({
        title: 'Email',
        message: 'Adresse email est requise',
        type: 'error'
      });
      if(formData.password == null || formData.password.trim() == "") return this.$notify({
        title: 'Mot de passe',
        message: 'Mot de passe est requis',
        type: 'error'
      });
      if(formData.level == null) return this.$notify({
        title: 'Profile',
        message: 'Profile est requis',
        type: 'error'
      });

      this.sign.active.signUpLoading = true;
      requester.signUp(JSON.stringify(formData))
      .then(response=>{
        this.sign.active.signUpLoading = false;
        if(!response.data.error){
          this.$notify({
            title: 'Compte',
            message: response.data.message,
            type: 'success'
          });
          this.sign.active.signIn = true;
        } else {
          this.$notify({
            title: 'Compte',
            message: response.data.message,
            type: 'error'
          });
        }
      })
      .catch(error=>{
        this.sign.active.signUpLoading = false;
        console.log(error);
      });
    },
  }
}
</script>

<style>

</style>