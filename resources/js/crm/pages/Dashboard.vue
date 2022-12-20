<template>
  <div class="dashboard_container">
    <div class="dashboard_wrapper">

      <section class="top_info mb-1">
        <v-row dense>
          <v-col cols="6" md="3">
            <v-card style="color:white" color="#111D5E">
              <v-card-text style="color:white" class="p-2">
                <v-row dense>
                  <v-col>
                    <h5 class="m-0">1780</h5>
                    <h6 class="m-0">Contacts</h6>
                  </v-col>
                  <v-col cols="auto" class="d-flex justify-content-center align-items-center">
                    <v-icon color="white">mdi-account</v-icon>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-divider class="m-0"></v-divider>
              <v-card-actions class="p-1">
                <v-icon small color="white">mdi-account-plus</v-icon>
                <p style="font-size:12px" class="ml-1 m-0">Extraction</p>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col cols="6" md="3">
            <v-card style="color:white" color="#CE1212">
              <v-card-text style="color:white" class="p-2">
                <v-row dense>
                  <v-col>
                    <h5 class="m-0">1500</h5>
                    <h6 class="m-0">Test effectué</h6>
                  </v-col>
                  <v-col cols="auto" class="d-flex justify-content-center align-items-center">
                    <v-icon color="white">mdi-clipboard-check</v-icon>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-divider class="m-0"></v-divider>
              <v-card-actions class="p-1">
                <v-icon small color="white">mdi-clock-time-nine-outline</v-icon>
                <p style="font-size:12px" class="ml-1 m-0">2h:30m</p>
                <p style="font-size:12px" class="ml-1 m-0">par jour</p>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col cols="6" md="3">
            <v-card style="color:white" color="#f39c12">
              <v-card-text style="color:white" class="p-2">
                <v-row dense>
                  <v-col>
                    <h5 class="m-0">1350</h5>
                    <h6 class="m-0">Mail confirmer</h6>
                  </v-col>
                  <v-col cols="auto" class="d-flex justify-content-center align-items-center">
                    <v-icon color="white">mdi-email-check</v-icon>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-divider class="m-0"></v-divider>
              <v-card-actions class="p-1">
                <v-icon small color="white">mdi-email-remove</v-icon>
                <p style="font-size:12px" class="ml-1 m-0">80</p>
                <p style="font-size:12px" class="ml-1 m-0">Non confirmer</p>
              </v-card-actions>
            </v-card>
          </v-col>

          <v-col cols="6" md="3">
            <v-card style="color:white" color="#038418">
              <v-card-text style="color:white" class="p-2">
                <v-row dense>
                  <v-col>
                    <h5 class="m-0">1200</h5>
                    <h6 class="m-0">Leads</h6>
                  </v-col>
                  <v-col cols="auto" class="d-flex justify-content-center align-items-center">
                    <v-icon color="white">mdi-account-check</v-icon>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-divider class="m-0"></v-divider>
              <v-card-actions class="p-1">
                <v-icon small color="white">mdi-phone</v-icon>
                <p style="font-size:12px" class="ml-1 m-0">120</p>
                <p style="font-size:12px" class="ml-1 m-0">Rapelle</p>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </section>

      <section class="mb-1">
        <v-row dense>
          <v-col cols="12" md="4">
            <v-card height="450">
            </v-card>
          </v-col>
          <v-col cols="12" md="8">
            <v-card height="450">
              <ColumnBar/>
            </v-card>
          </v-col>
        </v-row>
      </section>

      <section class="mb-1">
        <v-row dense>
          <v-col cols="12" md="8">
            <v-card height="450">
              <DiagramBar/>
            </v-card>
          </v-col>
          <v-col cols="12" md="4">
            <v-card height="450">
              <PieChart/>
            </v-card>
          </v-col>
        </v-row>
      </section>
    </div>
  </div>
</template>

<script>
import ColumnBar from "./dashboard/ColumnBar"
import DiagramBar from "./dashboard/DiagramBar"
import PieChart from "./dashboard/PieChart"
export default {
  components:{
    ColumnBar,
    DiagramBar,
    PieChart
  }
}
</script>

<style>

</style>