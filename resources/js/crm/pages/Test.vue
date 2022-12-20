<template>
  <div class="test_container">
    <div class="test_wrapper">
      <form autocomplete="off" v-on:submit.prevent action="#" class="test_form">
        <div class="form_header">
          <div class="fheader_wrapper">
            <div class="header_top">
              <h4 class="top_step"><span>é</span>tape<span>{{test.active.step}}</span></h4>
              <CountDownTimer :time="360" />
              <v-btn v-on:click="test.active.popup = true" color="#CE1212" small outlined text>
                Fermer<v-icon class="ml-1" small>mdi-exit-run</v-icon>
              </v-btn>
            </div>
            <div class="header_bottom">
              <h3 class="bottom_title" v-if="test.active.step != 9">{{test.data[test.active.step].title}}</h3>
              <h3 class="bottom_title" v-if="test.active.step == 9 && test.active.subStepCat == 1">{{test.data[test.active.step].website[test.active.subStep].title}}</h3>
              <h3 class="bottom_title" v-if="test.active.step == 9 && test.active.subStepCat == 2">{{test.data[test.active.step].crm[test.active.subStep].title}}</h3>
            </div>
          </div>
        </div>
        <div class="form_body">
          <template>
            <v-dialog v-model="test.result.isOpen" persistent max-width="600">
              <v-card :loading="test.result.isLoading">
                <v-card-title style="background:#111D5E">
                  <v-row dense justify="center">
                    <h5 style="color:white" class="m-0 text-center">Résultat du Test d'éligibilité</h5>
                  </v-row>
                </v-card-title>
                <v-card-text>
                  <template v-if="test.result.isLoading">
                    <v-row dense>
                      <v-col cols="12" md="12">
                        <v-skeleton-loader
                          type="article, actions"
                        ></v-skeleton-loader>
                      </v-col>
                    </v-row>
                  </template>
                  <template v-else>
                    <template v-if="test.result.isCpn">
                      <v-row dense>
                        <v-col class="d-flex flex-column align-items-center" cols="12" md="12" sm="12">
                          <h1 style="color:#038418" class="m-0 text-center">Félicitation</h1>
                          <h4 style="color:#038418" class="m-0 text-center">Vous étes éligible</h4>
                          <img class="mt-2" height="50" width="50" src="/public/img/tick_outline.svg" alt="tick">
                        </v-col>
                        <v-col cols="12" md="12" sm="12">
                          <h3 style="color:#111D5E" class="m-0 text-center">à une subvention <span style="font-weight:800">immédiate</span> offerte par le <span style="font-weight:800">cpn</span> d'un montant de</h3>
                          <h1 style="color:#CE1212" class="m-0 text-center"><span style="font-weight:700">{{test.result.cpn.amount}} €</span></h1>
                        </v-col>
                      </v-row>
                    </template>
                    <template v-else>
                      <v-row dense>
                        <v-col class="d-flex flex-column align-items-center" cols="12" md="12" sm="12">
                          <h1 :style="(test.result.regional.eligible)?'color:#038418':'color:#CE1212'" class="m-0 text-center">{{(test.result.regional.eligible)?"Félicitation":"Malheureusement"}}</h1>
                          <h4 :style="(test.result.regional.eligible)?'color:#038418':'color:#CE1212'" class="m-0 text-center">{{(test.result.regional.eligible)?"Vous étes éligible":"Vous n'étes pas éligible"}}</h4>
                          <img class="mt-2" height="50" width="50" :src="(test.result.regional.eligible)?'/public/img/tick_outline.svg':'/public/img/cross_outline.svg'" alt="icon">
                        </v-col>
                        <v-col v-if="test.result.regional.eligible" cols="12" md="12" sm="12">
                          <h3 style="color:#111D5E" class="m-0 text-center">Vous bénéficiez d'un</h3>
                          <h3 style="color:#111D5E; font-weight:800" class="m-0 text-center">{{test.result.regional.voucher}}</h3>
                          <h3 style="color:#111D5E;" class="m-0 mt-1 text-center">offert par votre région</h3>
                          <h3 style="color:#111D5E; font-weight:800" class="m-0 text-center">{{test.result.regional.region}}</h3>
                          <h1 style="color:#CE1212" class="m-0 text-center"><span style="font-weight:700">{{test.result.regional.amount}} €</span></h1>
                        </v-col>
                        <v-col v-else cols="12" md="12" sm="12">
                          <h3 style="color:#111D5E" class="m-0 text-center">Vous n'êtes pas éligible à l'aide régionale</h3>
                        </v-col>
                      </v-row>
                    </template>
                  </template>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="#038418" v-if="test.result.isCpn" v-on:click="showResult" small outlined text>
                    <v-icon small>mdi-arrow-right-circle</v-icon>
                  </v-btn>
                  <v-btn color="#038418" v-else v-on:click="showResult" small outlined text>
                    Fermer<v-icon class="ml-1" small>mdi-arrow-right-circle</v-icon>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="test.active.popup" width="300">
              <v-card>
                <v-card-title class="p-0">
                  <p class="w-100 m-0 text-center">Quitter le test d'éligibilité</p>
                </v-card-title>
                <v-card-text class="p-1">
                  <p class="w-100 m-0 text-center">Vous étes sur de vouloir quitter le test d'éligibilité ?</p>
                </v-card-text>
                <v-card-actions>
                  <v-btn v-on:click="test.active.popup = false" outlined text small color="green">Non</v-btn>
                  <v-spacer></v-spacer>
                  <v-btn v-on:click="closeTest" outlined text small color="red">Oui</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </template>
          <div class="fbody_wrapper">
            <div class="steps_content mb-3">
              <section class="step" v-if="test.active.step == 0">
                <v-row dense justify="center">
                  <v-col class="d-flex justify-content-center">
                    <v-btn disabled fab x-large>
                      <v-img width="0" src="/public/img/flags/france.svg"></v-img>
                    </v-btn>
                  </v-col>
                  <v-col class="d-flex justify-content-center">
                    <v-btn disabled fab x-large>
                      <v-img width="0" src="/public/img/flags/switzerland.svg"></v-img>
                    </v-btn>
                  </v-col>
                  <v-col class="d-flex justify-content-center">
                    <v-btn disabled fab x-large>
                      <v-img width="0" src="/public/img/flags/germany.svg"></v-img>
                    </v-btn>
                  </v-col>
                  <v-col class="d-flex justify-content-center">
                    <v-btn disabled fab x-large>
                      <v-img width="0" src="/public/img/flags/canada.svg"></v-img>
                    </v-btn>
                  </v-col>
                </v-row>
                <v-row class="my-10" dense justify="center">
                  <v-col class="d-flex justify-content-center">
                    <v-radio-group class="m-0 p-0" hide-details>
                      <v-row dense justify="center">
                        <v-col class="d-flex justify-content-center">
                          <v-radio disabled class="m-0" value="entreprise" color="#111D5E">
                            <template v-slot:label>
                              <div class="d-flex flex-row align-items-center justify-content-center">
                                <img width="50" src="public/img/icons/company.svg" alt="">
                                <p class="m-0 ml-1">Entreprises</p>
                              </div>
                            </template>
                          </v-radio>
                        </v-col>
                        <v-col class="mx-10 d-flex justify-content-center">
                          <v-radio disabled class="m-0" value="agence" color="#111D5E">
                            <template v-slot:label>
                              <div class="d-flex flex-row align-items-center justify-content-center">
                                <img width="50" src="public/img/icons/agency.svg" alt="">
                                <p class="m-0 ml-1">Agences</p>
                              </div>
                            </template>
                          </v-radio>
                        </v-col>
                        <v-col class="d-flex justify-content-center">
                          <v-radio disabled class="m-0" value="collectivité" color="#111D5E">
                            <template v-slot:label>
                              <div class="d-flex flex-row align-items-center justify-content-center">
                                <img width="50" src="public/img/icons/collectivity.svg" alt="">
                                <p class="m-0 ml-1">Collectivités</p>
                              </div>
                            </template>
                          </v-radio>
                        </v-col>
                      </v-row>
                    </v-radio-group>
                  </v-col>
                </v-row>
                <v-row dense justify="center">
                  <v-col class="d-flex justify-content-center">
                    <v-btn v-on:click="checkForm(test.active.step)" style="text-transform:none" rounded outlined text color="#111D5E" large>
                      Commencer le test<v-icon class="ml-1">mdi-arrow-right-circle</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 1">
                <div class="mb-3">
                  <v-text-field v-model="test.formData.address.zipcode" hide-details flat solo placeholder="Exemple : 12345"></v-text-field>
                </div>
                <MapFrench/>
              </section>
              <section class="step" v-if="test.active.step == 2" >
                <div class="">
                  <v-text-field v-model="test.formData.companies.name" hide-details flat solo placeholder="société abc"></v-text-field>
                </div>
              </section>
              <section class="step" v-if="test.active.step == 3">
                <div class="row g-3 justify-content-center">
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="SARL" name="companyStatus" id="companyStatus1">
                    <label class="input_radio_custom_label btn" for="companyStatus1">SARL</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="SAS" name="companyStatus" id="companyStatus2">
                    <label class="input_radio_custom_label btn" for="companyStatus2">SAS</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="SASU" name="companyStatus" id="companyStatus3">
                    <label class="input_radio_custom_label btn" for="companyStatus3">SASU</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="EURL" name="companyStatus" id="companyStatus4">
                    <label class="input_radio_custom_label btn" for="companyStatus4">EURL</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="MICRO-ENT" name="companyStatus" id="companyStatus5">
                    <label class="input_radio_custom_label btn" for="companyStatus5">MICRO-ENT</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="Artisan" name="companyStatus" id="companyStatus6">
                    <label class="input_radio_custom_label btn" for="companyStatus6">Artisan</label>
                  </div>
                  <div class="col-auto">
                    <input type="radio" v-model="test.formData.companies.status" class="btn-check input_radio_custom"  value="Individuelle" name="companyStatus" id="companyStatus7">
                    <label class="input_radio_custom_label btn" for="companyStatus7">Individuelle</label>
                  </div>
                </div>
              </section>
              <section class="step" v-if="test.active.step == 4">
                <v-row dense>
                  <v-col cols="12">
                    <v-autocomplete
                      :items="test.data[test.active.step].options"
                      item-text="name"
                      item-value="id"
                      v-model="test.formData.companies.activity"
                      label="Sélectionner un secteur d'activité"
                      hide-details
                      solo
                      flat
                      no-data-text="Pas de données"
                    ></v-autocomplete>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 5">
                <v-slider
                  v-model="test.formData.companies.turnover"
                  step="10"
                  min="-100"
                  max="100"
                  :color="sliderTurnoverColor"
                  thumb-size="50"
                  :tick-labels="test.data[test.active.step].labels"
                  thumb-label="always">
                    <template v-slot:thumb-label="{ value }">
                      {{ value+" %" }}
                    </template>
                </v-slider>
              </section>
              <section class="step" v-if="test.active.step == 6">
                <v-select
                  v-model="test.formData.companies.help"
                  :items="test.data[test.active.step].options"
                  menu-props="auto"
                  label="Select"
                  hide-details
                  solo
                  flat
                  single-line
                ></v-select>
              </section>
              <section class="step" v-if="test.active.step == 7">
                <v-range-slider class="mb-4"
                  v-model="test.data[test.active.step].selectedRange"
                  @change="setLastTurnover(test.data[test.active.step].selectedRange)"
                  step="1"
                  thumb-size="50"
                  :max="test.data[test.active.step].range.length-1"
                  :tick-labels="test.data[test.active.step].labels"
                  min="0"
                  thumb-label="always" >
                  <template v-slot:thumb-label="{ value }">
                    {{ (rangeValue(value)/1000 > 900)?(rangeValue(value)/1000)/1000 +"m €":(rangeValue(value)/1000) +"k €" }}
                  </template>
                </v-range-slider>
              </section>
              <section class="step" v-if="test.active.step == 8">
                <v-select
                  v-model="test.formData.companies.salaries"
                  :items="test.data[test.active.step].options"
                  menu-props="auto"
                  label="Select"
                  hide-details
                  solo
                  flat
                  single-line>
                </v-select>
              </section>
              <section class="step" v-if="test.active.step == 9">
                <div class="substep_a" v-if="test.active.subStepCat == 1">
                    <section class="substep" v-if="test.active.subStep == 1">
                      <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                          <input type="radio" v-model="test.formData.development.haveWebsite" class="btn-check input_radio_custom"  value="oui" name="haveWebsite" id="haveWebsite1">
                          <label class="input_radio_custom_label btn" for="haveWebsite1">Oui</label>
                        </div>
                        <div class="col-auto">
                          <input type="radio" v-model="test.formData.development.haveWebsite" class="btn-check input_radio_custom" value="non" name="haveWebsite" id="haveWebsite2">
                          <label class="input_radio_custom_label btn" for="haveWebsite2">Non</label>
                        </div>
                      </div>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 2">
                      <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.websiteType" value="E-commerce" name="websiteType" id="websiteType1" autocomplete="off">
                                <label class="input_radio_custom_label btn" for="websiteType1">E-commerce</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.websiteType" value="Vitrine" name="websiteType" id="websiteType2" autocomplete="off">
                                <label class="input_radio_custom_label btn" for="websiteType2">Vitrine</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.websiteType" value="Market-place" name="websiteType" id="websiteType3" autocomplete="off">
                                <label class="input_radio_custom_label btn" for="websiteType3">Market-place</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                            <div class="col">
                              <div class="input-group">
                                <span style="width:100px; font-size:16px; font-weight:100" class="input-group-text input-number-custom-sapn" id="websiteUser" v-if="test.formData.development.websiteType == 'E-commerce'">Vente</span>
                                <span style="width:100px; font-size:16px; font-weight:100" class="input-group-text input-number-custom-sapn" id="websiteUser" v-if="test.formData.development.websiteType == 'Vitrine'">Visiteur</span>
                                <span style="width:100px; font-size:16px; font-weight:100" class="input-group-text input-number-custom-sapn" id="websiteUser" v-if="test.formData.development.websiteType == 'Market-place'">Utilisateur</span>
                                <input v-if="test.formData.development.websiteType != null" style="padding-left:10px" type="number" class="form-control input-number-custom" v-model="test.formData.development.websiteValue" name="websiteValue" min="0" step="10" id="websiteUser">
                              </div>
                            </div>
                          </div>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 3">
                      <v-text-field v-model="test.formData.development.websiteLink" hide-details flat solo placeholder="www.siteweb.com"></v-text-field>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 4">
                      <el-date-picker
                        style="width:100%"
                        v-model="test.formData.development.websiteDate"
                        type="year"
                        placeholder="Sélectionnez une année">
                      </el-date-picker>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 5">
                      <v-text-field v-model="test.formData.development.agencyName" hide-details flat solo placeholder="Nom de l'agence"></v-text-field>
                    </section>
                  </div>
                  <div class="substep_b" v-if="test.active.subStepCat == 2">
                    <section class="substep" v-if="test.active.subStep == 1">
                      <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                          <input type="radio" v-model="test.formData.development.haveCrm" class="btn-check input_radio_custom"  value="oui" name="haveCrm" id="haveCrm1">
                          <label class="input_radio_custom_label btn" for="haveCrm1">Oui</label>
                        </div>
                        <div class="col-auto">
                          <input type="radio" v-model="test.formData.development.haveCrm" class="btn-check input_radio_custom" value="non" name="haveCrm" id="haveCrm2">
                          <label class="input_radio_custom_label btn" for="haveCrm2">Non</label>
                        </div>
                      </div>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 2">
                      <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.crmType" value="ERP" name="crmType" id="crmType1" autocomplete="off">
                                <label class="input_radio_custom_label btn btn-secondary" for="crmType1">ERP</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.crmType" value="CRM" name="crmType" id="crmType2" autocomplete="off">
                                <label class="input_radio_custom_label btn btn-secondary" for="crmType2">CRM</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="row">
                            <div class="col-auto">
                              <div class="">
                                <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.crmType" value="CRM-ERP" name="crmType" id="crmType3" autocomplete="off">
                                <label class="input_radio_custom_label btn btn-secondary" for="crmType3">CRM-ERP</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 3">
                      <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                          <div class="">
                            <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.crmDev" value="interne" name="crmDevelopement" id="crmDevelopement1">
                            <label class="btn btn-secondary input_radio_custom_label" for="crmDevelopement1">Interne</label>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="">
                            <input type="radio" class="btn-check input_radio_custom" v-model="test.formData.development.crmDev" value="externe" name="crmDevelopement" id="crmDevelopement2">
                            <label class="btn btn-secondary input_radio_custom_label" for="crmDevelopement2">Externe</label>
                          </div>
                        </div>
                      </div>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 4">
                      <v-row dense>
                        <v-col cols="12">
                          <v-autocomplete
                            :items="test.data[test.active.step].crm[test.active.subStep].options"
                            item-text="name"
                            item-value="name"
                            v-model="test.formData.development.erpName"
                            label="Sélectionner un ERP"
                            hide-details
                            solo
                            flat
                            no-data-text="Pas de données"
                          ></v-autocomplete>
                        </v-col>
                      </v-row>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 5">
                      <v-row dense>
                        <v-col cols="12">
                          <v-autocomplete
                            :items="test.data[test.active.step].crm[test.active.subStep].options"
                            item-text="name"
                            item-value="name"
                            v-model="test.formData.development.crmName"
                            label="Sélectionner un CRM"
                            hide-details
                            solo
                            flat
                            no-data-text="Pas de données"
                          ></v-autocomplete>
                        </v-col>
                      </v-row>
                    </section>
                    <section class="substep" v-if="test.active.subStep == 6">
                      <el-date-picker
                        style="width:100%"
                        v-model="test.formData.development.crmDate"
                        type="year"
                        placeholder="Sélectionnez une année">
                      </el-date-picker>
                    </section>
                  </div>
              </section>
              <section class="step" v-if="test.active.step == 10">
                <template>
                  <v-tabs
                  :color="(test.data[test.active.step].tabServices == 0)?'#CE1212':'#111D5E'"
                  v-model="test.data[test.active.step].tabServices" grow>
                    <v-tab v-for="item in test.data[test.active.step].services" :key="item">
                      {{ item }}
                    </v-tab>
                  </v-tabs>
                  <v-tabs-items v-model="test.data[test.active.step].tabServices">
                    <v-tab-item>
                      <v-card :loading="test.data[test.active.step].loading" flat>
                        <v-list max-height="450" class="scroll_bar_custom" flat subheader three-line>
                          <v-list-item-group >
                            <template v-for="item in filterTransitions('Services')">
                              <v-list-item :key="item.name">
                                <v-list-item-avatar size="50">
                                  <v-img :contain="true" height="30" :src="'public/img/transitions/'+item.logo+'.svg'"></v-img>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                  <v-list-item-title style="color:#CE1212">{{item.name}} <sub style="color:black">MB{{item.budget}}</sub></v-list-item-title>
                                  <!-- <v-list-item-subtitle>
                                    <v-autocomplete class="p-0"
                                      dense
                                      item-text="name"
                                      item-value="id"
                                      :items="item.orientation"
                                      label="Sélectionner une orientation"
                                      hide-details
                                      solo
                                      flat
                                      no-data-text="Pas de données"
                                    ></v-autocomplete>
                                  </v-list-item-subtitle> -->
                                  <v-list-item-subtitle>{{item.desc}}</v-list-item-subtitle>
                                  <v-list-item-subtitle>{{item.category}}</v-list-item-subtitle>
                                </v-list-item-content>
                                <v-list-item-action>
                                  <v-checkbox v-model="test.formData.investment.service" :value="item.id" name="service"></v-checkbox>
                                </v-list-item-action>
                              </v-list-item>
                            </template>
                          </v-list-item-group>
                        </v-list>
                      </v-card>
                    </v-tab-item>
                    <v-tab-item>
                      <template>
                        <v-tabs
                        color="#111D5E"
                        v-model="test.data[test.active.step].tabCategories" grow>
                          <v-tab v-for="item in test.data[test.active.step].categories" :key="item">
                            {{ item }}
                          </v-tab>
                        </v-tabs>
                        <v-tabs-items v-model="test.data[test.active.step].tabCategories">
                          <v-tab-item v-for="item in test.data[test.active.step].categories" :key="item">
                            <v-card flat>
                              <v-list max-height="450" class="scroll_bar_custom" flat subheader three-line>
                                <v-list-item-group>
                                  <template v-for="item in filterTransitions(test.data[test.active.step].categories[test.data[test.active.step].tabCategories])">
                                    <v-list-item :key="item.name">
                                      <v-list-item-avatar size="50">
                                        <v-img :contain="true" height="30" :src="'public/img/transitions/'+item.logo+'.svg'"></v-img>
                                      </v-list-item-avatar>
                                      <v-list-item-content>
                                        <v-list-item-title style="color:#111D5E">{{item.name}}</v-list-item-title>
                                        <v-list-item-subtitle>{{item.desc}}</v-list-item-subtitle>
                                        <v-list-item-subtitle>{{item.category}}</v-list-item-subtitle>
                                      </v-list-item-content>
                                      <v-list-item-action>
                                        <v-checkbox v-model="test.formData.investment.digitalTransitions" :value="item.name" name="digitalTransitions[]"></v-checkbox>
                                      </v-list-item-action>
                                    </v-list-item>
                                  </template>
                                </v-list-item-group>
                              </v-list>
                            </v-card>
                          </v-tab-item>
                        </v-tabs-items>
                      </template>
                    </v-tab-item>
                  </v-tabs-items>
                </template>
              </section>
              <section class="step" v-if="test.active.step == 11">
                <v-slider
                  v-model="test.data[test.active.step].budget"
                  step="1"
                  min="3"
                  max="1000"
                  thumb-size="60"
                  :color="sliderBudgetColor"
                  thumb-label="always">
                    <template v-slot:thumb-label="{ value }">
                      {{ value*100+" €" }}
                    </template>
                  </v-slider>
              </section>
              <section class="step" v-if="test.active.step == 12">
                <v-row>
                  <v-col cols="12" md="12">
                    <v-text-field @change="getNafCompany" v-model="test.formData.companies.siret" hide-details flat solo placeholder="Numéro SIRET (siège)"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="12">
                    <v-text-field disabled v-model="test.formData.companies.siren" hide-details flat solo placeholder="Numéro SIREN"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="12">
                    <v-text-field :loading="test.data[test.active.step].loading" v-model="test.formData.companies.naf" hide-details flat solo placeholder="Code naf/ape"></v-text-field>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 13">
                <v-row>
                  <v-col cols="12" md="12">
                    <vue-google-autocomplete v-model="test.formData.address.line" style="box-shadow:none;outline:none;border:none;height:48px" id="map" classname="form-control" placeholder="Adresse" v-on:placechanged="getAddressData"></vue-google-autocomplete>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field disabled v-model="test.formData.address.region" hide-details flat solo placeholder="Région"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field disabled v-model="test.formData.address.departement" hide-details flat solo placeholder="Département"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field disabled v-model="test.formData.address.city" hide-details flat solo placeholder="Ville"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field disabled v-model="test.formData.address.zipcode" hide-details flat solo placeholder="Code postale"></v-text-field>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 14">
                <v-row>
                  <v-col cols="12" md="6">
                    <v-text-field v-model="test.formData.contacts.firstName" hide-details flat solo placeholder="Prénom"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field v-model="test.formData.contacts.lastName" hide-details flat solo placeholder="Nom de famille"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="12">
                    <v-text-field v-model="test.formData.contacts.email" hide-details flat solo placeholder="Email"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field v-model="test.formData.contacts.phone" hide-details flat solo placeholder="Numéro personelle"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field v-model="test.formData.companies.phone" hide-details flat solo placeholder="Numéro entreprise"></v-text-field>
                  </v-col>
                  <v-col cols="12" md="12">
                    <v-select
                      v-model="test.formData.contacts.position"
                      :items="test.data[test.active.step].options"
                      menu-props="auto"
                      label="Poste"
                      hide-details
                      solo
                      flat
                      single-line
                    ></v-select>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 15">
                <v-row dense justify="center">
                  <v-col cols="8">
                    <Agenda :contactID="test.formData.contactID" :contactName="test.formData.contacts.firstName+' '+test.formData.contacts.lastName" />
                    <v-row dense class="mt-1" style="padding:0 10px">
                      <v-col cols="12" md="6" sm="6">
                        <input type="radio" v-model="test.formData.meetingType" class="btn-check input_radio_custom" value="Entretien vidéo conférence" name="meetingType" id="meetingType1">
                        <label class="input_radio_custom_label full_width btn" for="meetingType1">Entretien vidéo conférence</label>
                      </v-col>
                      <v-col cols="12" md="6" sm="6">
                        <input type="radio" v-model="test.formData.meetingType" class="btn-check input_radio_custom" value="Visite de courtoise" name="meetingType" id="meetingType2">
                        <label class="input_radio_custom_label full_width btn" for="meetingType2">Visite de courtoise</label>
                      </v-col>
                      <v-col cols="12" md="12" sm="12">
                        <v-btn :loading="test.zoom.generating" :disabled="test.zoom.generated" large elevation="0" v-on:click="generateZoomLink" color="white" style="width:100%; color:#6c757d; text-transform:inherit">Générer un rendez-vous zoom</v-btn>
                      </v-col>
                      <v-col cols="12" md="12" sm="12">
                        <v-text-field disabled v-model="test.formData.advisorName" hide-details flat solo placeholder="Nom téléconseiller"></v-text-field>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </section>
              <section class="step" v-if="test.active.step == 16">
                <v-slider class="mb-5"
                  v-model="test.formData.contacts.type"
                  step="1"
                  max="5"
                  thumb-size="50"
                  color="#111D5E"
                  :tick-labels="test.data[test.active.step].labels"
                  thumb-label="always">
                  <template v-slot:thumb-label="{ value }">
                    <span style="font-size: 25px;">{{ test.data[test.active.step].items[value] }}</span>
                  </template>
                </v-slider>
                <v-textarea v-model="test.formData.contacts.comment" hide-details flat solo placeholder="Commentaire"></v-textarea>
              </section>
              <section class="step" v-if="test.active.step == 17">
              </section>
            </div>
          </div>
        </div>
        <div class="form_footer">
          <div class="ffooter_wrapper">
            <div class="footer_top">
              <v-spacer></v-spacer>
              <v-btn color="#111D5E" v-if="test.active.step > 1 && test.active.step < 15" v-on:click="prevStep" small outlined text>
                Précédent<v-icon class="ml-1" small>mdi-arrow-left-circle</v-icon>
              </v-btn>
              <v-btn color="#111D5E" v-if="test.data.length-2 > test.active.step && test.active.step > 0" class="ml-2" v-on:click="checkForm(test.active.step)" small outlined text>
                Suivant<v-icon class="ml-1" small>mdi-arrow-right-circle</v-icon>
              </v-btn>
              <v-btn color="#038418" :disabled="test.active.confirmed" v-if="test.active.step == 16" class="ml-2" v-on:click="submitForm" small outlined text>
                Confirmer<v-icon class="ml-1" small>mdi-send-circle</v-icon>
              </v-btn>
            </div>
            <div class="footer_bottom">
              <div class="bottom_progress">
                <!-- <span id="progressVal" class="progress_text">0%</span> -->
                <span id="progressBar" class="progress_bar"></span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import CountDownTimer from "../components/CountdownTimer"
import VueGoogleAutocomplete from 'vue-google-autocomplete'
import MapFrench from "../components/MapFrench";
import Agenda from "../components/Agenda";
import requester from "../modules/requester";
export default {
  components:{
    CountDownTimer,
    MapFrench,
    Agenda,
    VueGoogleAutocomplete
  },
  data(){
    return {
      test:{
        active:{
          step:0,
          subStep:1,
          subStepCat:0,
          stepType:"form",
          popup:false,
          confirmed:false,
        },
        result:{
          isOpen:false,
          isLoading:false,
          isCpn:true,
          regional:{
            id:null,
            region:null,
            eligible:false,
            voucher:null,
            amount:null,
          },
          cpn:{
            id:null,
            amount:null,
            originalPrice:null,
            sellPrice:null,
          },
        },
        zoom:{
          generating:false,
          generated:false,
        },
        formData:{
          advisorName:this.$store.state.user.data.first_name+" "+this.$store.state.user.data.last_name,
          contactID:null,
          meetingType:null,
          address:{
            line:null,
            zipcode:null,
            region:null,
            departement:null,
            city:null,
            country:null,
          },
          contacts:{
            firstName:null,
            lastName:null,
            email:null,
            phone:null,
            position:null,
            type:3,
            comment:null,
          },
          companies:{
            name:null,
            status:null,
            activity:null,
            help:null,
            salaries:null,
            siret:null,
            siren:null,
            naf:null,
            phone:null,
            turnover:0,
            lastTurnover:null,
            help:null
          },
          development:{
            haveWebsite:null,
            websiteType:null,
            websiteValue:null,
            websiteLink:null,
            websiteDate:null,
            haveCrm:null,
            crmType:null,
            crmDev:null,
            crmName:null,
            erpName:null,
            crmDate:null,
            agencyName:null,
          },
          investment:{
            service:null,
            budget:0,
            digitalTransitions:[],
          },
        },
        orientations:[],
        data:[
          {
            step:0,
            title:"Bienvenue"
          },
          {
            step: 1,
            title:"Renseigner le code postal",
          },
          {
            step:2,
            title:"Nom de l'entreprise"
          },
          {
            step:3,
            title:"Statut juridique"
          },
          {
            step:4,
            title:"Secteur d'activité",
            options:[],
          },
          {
            step:5,
            title:"Avez vous perdu du chiffre d'affaires pendant la crise sanitaire",
            labels:[
              "Baisse",
              "",
              "",
              "",
              "",
              "-50%",
              "",
              "",
              "",
              "",
              "Stable",
              "",
              "",
              "",
              "",
              "50%",
              "",
              "",
              "",
              "",
              "Hausse"
            ],
          },
          {
            step:6,
            title:"Avez vous déja obtenu des aides de l'état",
            options:[
              "Chéque numérique et aide numérique de votre région",
              "Crédit d'impôt",
              "Fond de solidarité",
              "Chaumage partiel",
              "Aucune aide",
            ],
          },
          {
            step:7,
            title:"Dernier chiffre d'affaires réalisé",
            labels:[
              "5k €",
              "",
              "",
              "",
              "",
              "",
              "",
              "",
              "700k €",
              "",
              "",
              "",
              "",
              "",
              "",
              "",
              "3.5m €",
              "",
              "",
              "",
              "",
              "",
              "",
              "",
              "7.5m €",
              "",
              "",
              "",
              "",
              "",
              "",
              "",
              "",
              "30m €",
            ],
            selectedRange:[0,1],
            range:[
              5000,
              50000,
              100000,
              200000,
              300000,
              400000,
              500000,
              600000,
              700000,
              800000,
              900000,
              1000000,
              1500000,
              2000000,
              2500000,
              3000000,
              3500000,
              4000000,
              4500000,
              5000000,
              5500000,
              6000000,
              6500000,
              7000000,
              7500000,
              8000000,
              8500000,
              9000000,
              9500000,
              10000000,
              15000000,
              20000000,
              25000000,
              30000000,
            ],
          },
          {
            step:8,
            title:"Nombre de salariés",
            options:[
              "de 0 à 5 Personnes",
              "de 5 à 10 Personnes",
              "de 10 à 20 Personnes",
              "de 20 à 30 Personnes",
              "de 30 à 40 Personnes",
              "de 40 à 50 Personnes",
              "plus de 50 Personnes",
            ],
          },
          {
            step:9,
            title:"Type de site",
            website:[
              {
                subStep:0,
                title:""
              },
              {
                subStep:1,
                title:"Avez vous un site internet pour votre entreprise"
              },
              {
                subStep:2,
                title:"Type de site"
              },
              {
                subStep:3,
                title:"Lien de site"
              },
              {
                subStep:4,
                title:"Date de développement"
              },
              {
                subStep:5,
                title:"L'agence qui a développé votre site"
              }
            ],
            crm:[
              {
                subStep:0,
                title:""
              },
              {
                subStep:1,
                title:"Avez vous un crm pour votre entreprise"
              },
              {
                subStep:2,
                title:"Type de crm"
              },
              {
                subStep:3,
                title:"Le crm a été développé"
              },
              {
                subStep:4,
                title:"Quel type de ERP vous utilisez",
                options:[
                  "Zoho",
                  "SAP",
                  "Sage",
                  "Oracle",
                  "NetSuite",
                  "Cegid",
                  "Microsoft Dynamics",
                  "Divalto",
                  "WaveSoft",
                  "Odoo",
                  "Archipelia",
                  "Axonaut",

                ]
              },
              {
                subStep:5,
                title:"Quel type de CRM vous utilisez",
                options:[
                  "Zoho",
                  "Habspot",
                  "Microsoft Dynamics",
                  "SalesForce",
                  "Pipedrive",
                  "Agile",
                  "Axonaut",
                  "FreshSales",
                  "Teamleader",
                  "Facture",
                  "Crème",
                  "Suite",
                ]
              },
              {
                subStep:6,
                title:"Date de développement"
              }
            ]
          },
          {
            step:10,
            title:"Quel projet est à subventionner pour votre transition numérique",
            tabServices:null,
            loading:false,
            services:["Services éligible", "Services suplémentaire"],
            tabCategories:null,
            categories:["Tous", "Graphique", "Développement","Montage","Marketing"],
            options:[],
          },
          {
            step:11,
            title:"Budget d'investissement",
            budget:5,
            min:400,
            target:500,
            max:100000,
          },
          {
            step:12,
            title:"Numéros d'identification",
            loading:false,
          },
          {
            step:13,
            title:"Adresse",
          },
          {
            step:14,
            title:"Fiche de renseignement",
            options:[
              "Gérant",
              "Directeur",
              "Associé",
              "Autre"
            ],
          },
          {
            step:15,
            title:"Vos disponibilités",
          },
          {
            step:16,
            title:"Type de client",
            items: ['☹️', '🙁', '😐', '🙂', '😊', '😍'],
            labels:[
              "agressif",
              "indécis",
              "anxieux",
              "économe",
              "compréhensif",
              "roi",
            ]
          },
          {
            step:17,
            title:"Merci pour votre temps",
          },
        ],
      }
    }
  },
  created:function(){
    requester.activitiesGet()
    .then((response)=>{
      this.test.data[4].options = response.data.data
    })
    .catch((error)=>console.log(error));

    requester.transitionsGet()
    .then((response)=>{
      console.log(response.data)
      this.test.data[10].options = response.data.data
    })
    .catch((error)=>console.log(error));
  },

  mounted:function(){
    this.mapHandler();
    this.progressUpdate();
    this.$bus.$on("Timer/result", (data)=>{
      requester.saveTimer(JSON.stringify({timer:data}))
      .then(response=>console.log(response.data))
      .catch(error=>console.log(error));
    });
  },

  updated:function(){
    this.mapHandler();
    this.progressUpdate();
  },

  computed:{
    sliderTurnoverColor(){
      if (this.test.formData.companies.turnover == 0) return '#111D5E'
      if (this.test.formData.companies.turnover < 0 && this.test.formData.companies.turnover >= -50 ) return '#ffcf03'
      if (this.test.formData.companies.turnover < -50) return '#CE1212'
      if (this.test.formData.companies.turnover > 0) return '#038418'
    },
    sliderBudgetColor(){
      this.test.formData.investment.budget = this.test.data[this.test.active.step].budget * 100;
      if(this.test.data[this.test.active.step].budget*100 <= this.test.data[this.test.active.step].min) return '#CE1212';
      if(this.test.data[this.test.active.step].budget*100 < this.test.data[this.test.active.step].target) return '#f39c12';
      if(this.test.data[this.test.active.step].budget*100 == this.test.data[this.test.active.step].target) return '#ffcf03';
      if(this.test.data[this.test.active.step].budget*100 > this.test.data[this.test.active.step].max) return '#111D5E';
      else return '#038418';
    },
    watchRange(){
      return this.test.data[7].selectedRange;
    }
  },

  watch:{
    'test.formData.address.zipcode':function (newVal, oldVal) {
      this.filterRegion(newVal);
    },
    'watchRange':function (newVal, oldVal){
      if(newVal[1] > oldVal[1]) {
        this.test.data[7].selectedRange[0] = newVal[1] - 1
        this.test.data[7].selectedRange[1] = newVal[1]
      } else if(newVal[0] < oldVal[0]){
        if(newVal[0] == 0){
          this.test.data[7].selectedRange[0] = 0
          this.test.data[7].selectedRange[1] = 1
        } else {
          this.test.data[7].selectedRange[0] = newVal[0]
          this.test.data[7].selectedRange[1] = newVal[0] -1
        }
      }
    },
    'test.formData.companies.siret':function (newVal, oldVal){
      this.getNafCompany(newVal);
    }
  },

  methods:{

    progressUpdate(){
        //var progressTxt= document.getElementById('progressVal');
        var progressBar = document.getElementById('progressBar');
        let progressVal = Math.round((this.test.active.step/(this.test.data.length-1))*100);
        //progressTxt.innerHTML = progressVal+"%";
        progressBar.style.width = progressVal+"%";
    },

    mapHandler(){
      if(this.test.active.step == 1){
        var that = this;
        let mapCityName = document.getElementById("placeName")
        let map = document.getElementById("svgContent");
        let region = map.querySelectorAll(".region");
        region.forEach((item,index)=>{
          item.addEventListener("mouseover",function(e) {
            mapCityName.innerHTML = item.dataset.name;
          })
          let department = item.querySelectorAll('.departement')
          department.forEach((pathItem,index) => {
            pathItem.addEventListener("mouseover",function(e) {
              mapCityName.innerHTML ="<b>"+item.dataset.name+"</b> : "+pathItem.dataset.name+" <sup>("+pathItem.dataset.department+")</sup>";
              e.stopPropagation()
            })
            pathItem.addEventListener("click",function (e) {
              pathItem.classList.add("selected");
              that.test.formData.address.region = item.dataset.name;
              that.test.formData.address.departement = pathItem.dataset.name;
              that.test.formData.address.zipcode = pathItem.dataset.department;
            })
          })
        })
      }
    },
    filterRegion(val){
      var that = this;
      let mapCityName = document.getElementById("placeName")
      let map = document.getElementById("svgContent");
      let region = map.querySelectorAll(".region");
      region.forEach((regionItem)=>{
        let departement = regionItem.querySelectorAll('.departement');
        departement.forEach((departementItem)=>{
          departementItem.classList.remove("selected");
          if(departementItem.dataset.department == val.substring(0, 2) || departementItem.dataset.department == val.substring(0, 3)){
            mapCityName.innerHTML ="<b>"+regionItem.dataset.name+"</b> : "+departementItem.dataset.name+" <sup>("+departementItem.dataset.department+")</sup>";
            that.test.formData.address.region = regionItem.dataset.name;
            that.test.formData.address.departement = departementItem.dataset.name;
            departementItem.classList.add("selected");
          }
        });
      });
    },

    rangeValue(val){
      return this.test.data[this.test.active.step].range[val];
    },

    setLastTurnover(val){
      const step = this.test.active.step;
      let range = [
        this.test.data[step].range[val[0]],
        this.test.data[step].range[val[1]]
      ];
      requester.serviceTurnover(range).then(response=>{
        this.test.formData.investment.service = response.data.data.transition_id;
        this.test.formData.companies.lastTurnover = response.data.data.id;

        this.test.formData.investment.budget = Math.ceil(response.data.data.budget/100)*100;

        this.test.data[11].budget = Math.ceil(response.data.data.budget/100);

        this.test.data[11].min = Math.ceil(response.data.data.budget_min/100)*100;
        this.test.data[11].target = Math.ceil(response.data.data.budget/100)*100;
        this.test.data[11].max = Math.ceil(response.data.data.budget_max/100)*100;

      }).catch(error=>console.log(error));
    },

    filterTransitions(name){
      const step = this.test.active.step;
      if(name == ""||name == null||name=="Tous")return this.test.data[step].options;
      else return this.test.data[step].options.filter(item => {return item.category.indexOf(name) > -1})
    },

    getNafCompany(siret){
      let siren = siret.substring(0,9);
      this.test.formData.companies.siren = siren;
      this.test.data[this.test.active.step].loading = true;
      if(siren.length == 9 && siret.length == 14){
        requester.comapnySiren(siren).then(response=>{
          this.test.data[this.test.active.step].loading = false;
          this.test.formData.companies.naf = response.data.ape;
        }).catch(error=>console.log(error));
      }
    },

    getAddressData (addressData, placeResultData, id) {
      let street = addressData.street_number;
      let route = addressData.route;
      let city = addressData.locality;
      let country = addressData.country;
      this.test.formData.address.line = street+" "+route;
      this.test.formData.address.city = city;
      this.test.formData.address.country = country;
    },

    submitForm(){
      this.test.active.confirmed = true;
      let contact = new Map();
      contact["cid"] = this.test.formData.contactID;
      contact["situation"] = this.test.data[16].labels[this.test.formData.contacts.type];
      contact["comment"] = this.test.formData.contacts.comment;
      contact["cpnID"] = this.test.result.cpn.id;
      contact["regionID"] = this.test.result.regional.id;
      requester.confirmContact(JSON.stringify(contact))
      .then(response=>{
        if(!response.data.error){
          this.$notify({title: 'Contact', message: response.data.message, type: 'success'});
          this.$bus.$emit("Timer/stop");
          this.nextStep();
        } else {
          this.test.active.confirmed = false;
        }
      })
      .catch(error=>{
        console.log(error);
        this.test.active.confirmed = false;
      });
    },

    prevStep(){
      this.test.active.step-=1;
    },

    nextStep(){
      this.test.active.step+=1
    },

    nextSubStep(){
      this.test.active.subStep+=1
    },

    showResult(){
      let budget = this.test.formData.investment.budget;
      let service = this.test.formData.investment.service;
      let region = this.test.formData.address.region;
      let naf = this.test.formData.companies.naf;
      switch (this.test.result.isOpen) {
        case true:
          if(this.test.result.isCpn){
            this.test.result.isCpn = false;
            this.test.result.isLoading = true;
            requester.regionalGrant(region,budget,naf)
            .then(response=>{
              if(response.data.eligible){
                this.test.result.regional.id = response.data.id;
                this.test.result.regional.eligible = response.data.eligible;
                this.test.result.regional.voucher = response.data.voucher;
                this.test.result.regional.amount = response.data.amount;
                this.test.result.regional.region = response.data.region;
              } else {
                this.test.result.regional.eligible = response.data.eligible;
                this.test.result.regional.voucher = null;
                this.test.result.regional.amount = null;
              }
              this.test.result.isLoading = false;
            })
            .catch(error=>{
              this.test.result.isLoading = false;
              console.log(error)
            });
          } else {
            this.setContactForm(this.test.formData);
            this.test.result.isCpn = true;
            this.test.result.isOpen = false;
            this.nextStep();
          }
          break;
        case false:
          this.test.result.isOpen = true;
          this.test.result.isLoading = true;
          requester.cpnGrant(service,budget)
          .then(response=>{
            this.test.result.cpn.id = response.data.id;
            this.test.result.cpn.amount = response.data.grants;
            this.test.result.cpn.originalPrice = response.data.original_price;
            this.test.result.cpn.sellPrice = response.data.sell_price;
            this.test.result.isLoading = false;
          })
          .catch(error=>{
            this.test.result.isLoading = false;
            console.log(error)
          })
          break;
      }
    },

    setContactForm(formData){
      requester.saveContact(JSON.stringify(formData))
      .then(response=>{
        if(!response.data.error){
          this.test.formData.contactID = response.data.cid;
        }
      })
      .catch(error=>console.log(error));
    },

    checkForm(step){
      let subStep = this.test.active.subStep;
      let subStepCat = this.test.active.subStepCat;
      switch (step) {
        case 0:
          this.$bus.$emit('Timer/start');
          this.nextStep();
          break;
        case 1:
          if(this.test.formData.address.zipcode == null) this.$notify({
            title: 'Ètape '+step,
            message: "Code postale est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 2:
          if(this.test.formData.companies.name == null) this.$notify({
            title: 'Ètape '+step,
            message: "Nom de la société est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 3:
          if(this.test.formData.companies.status == null) this.$notify({
            title: 'Ètape '+step,
            message: "Statut juridique est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 4:
          if(this.test.formData.companies.activity == null) this.$notify({
            title: 'Ètape '+step,
            message: "Secteur d'activité est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 5:
          if(this.test.formData.companies.turnover == null) this.$notify({
            title: 'Ètape '+step,
            message: "Chiffre d'affaires est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 6:
          if(this.test.formData.companies.help == null) this.$notify({
            title: 'Ètape '+step,
            message: "Aide de l'état est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 7:
          if(this.test.formData.companies.lastTurnover == null) this.$notify({
            title: 'Ètape '+step,
            message: "Dernier chiffre d'affaires est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 8:
          if(this.test.formData.companies.salaries == null) this.$notify({
            title: 'Ètape '+step,
            message: "Nombre de salariés est requis",
            type: 'error'
          });
          else if(this.test.formData.companies.lastTurnover >= 10){
            if(this.test.formData.companies.salaries == "de 0 à 5 Personnes" || this.test.formData.companies.salaries == "de 5 à 10 Personnes"){
              this.test.active.subStepCat = 1;
              this.test.active.subStep = 1;
              this.nextStep();
            } else {
              this.test.active.subStepCat = 2;
              this.test.active.subStep = 1;
              this.nextStep();
            }
          }
          else {
            this.test.active.subStepCat = 1;
            this.test.active.subStep = 1;
            this.nextStep();
          }
          break;
        case 9:
          switch (subStepCat) {
            case 1:
              switch (subStep) {
                case 1:
                  if(this.test.formData.development.haveWebsite == null) this.$notify({
                    title: 'Step '+step+"."+subStep,
                    message: "Vous devez répondre a cette question",
                    type: 'error'
                  });
                  else if(this.test.formData.development.haveWebsite == "oui"){
                    this.nextSubStep();
                  } else {
                    this.nextStep();
                  };
                  break;
                case 2:
                  if(this.test.formData.development.websiteType == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Vous devez choisir le type du site web",
                    type: 'error'
                  });
                  else if(this.test.formData.development.websiteValue == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Vous devez mettre une valeur",
                    type: 'error'
                  });
                  else this.nextSubStep();
                  break;
                case 3:
                  if(this.test.formData.development.websiteLink == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Lien de site web est requis",
                    type: 'error'
                  });
                  else this.nextSubStep();
                  break;
                case 4:
                  if(this.test.formData.development.websiteDate == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Date du développement est requis",
                    type: 'error'
                  });
                  else this.nextSubStep();
                  break;
                case 5:
                  if(this.test.formData.development.agencyName == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Nom de l'agence est requis",
                    type: 'error'
                  });
                  else this.nextStep();
                  break;
              }
              break;
            case 2:
              switch (subStep) {
                case 1:
                  if(this.test.formData.development.haveCrm == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Vous devez répondre à cette question",
                    type: 'error'
                  });
                  else if(this.test.formData.development.haveCrm == "oui"){
                    this.nextSubStep();
                  } else {
                    this.test.active.subStepCat = 1;
                  };
                  break;
                case 2:
                  if(this.test.formData.development.crmType == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Vous devez choisir le type du crm",
                    type: 'error'
                  });
                  else this.nextSubStep();
                  break;
                case 3:
                  if(this.test.formData.development.crmDev == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Vous devez choisir le type du développement",
                    type: 'error'
                  });
                  else this.nextSubStep();
                  break;
                case 4:
                  this.nextSubStep();
                  break;
                case 5:
                  this.nextSubStep();
                  break;
                case 6:
                  if(this.test.formData.development.crmDate == null) this.$notify({
                    title: 'Ètape '+step+"."+subStep,
                    message: "Date du développement est requis",
                    type: 'error'
                  });
                  else {
                    this.test.active.subStepCat = 1;
                    this.test.active.subStep = 1;
                  };
                  break;
              }
              break;
          }
          break;
        case 10:
          if(this.test.formData.investment.service == null || this.test.formData.investment.service == "") this.$notify({
            title: 'Ètape '+step,
            message: "Vous devez sélectionner un service",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 11:
          if(this.test.data[11].min > this.test.formData.investment.budget) this.$notify({
            title: 'Ètape '+step,
            message: "Vous avez dépassé le minimum à investir dans ce projet",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 12:
          if(this.test.formData.companies.siret == null) this.$notify({
            title: 'Ètape '+step,
            message: "Numéro de siret est requis",
            type: 'error'
          });
          else if(this.test.formData.companies.siret.length < 14) this.$notify({
            title: 'Ètape '+step,
            message: "Numéro de Siret doit contenir 14 chiffres",
            type: 'error'
          });
          else if(this.test.formData.companies.naf == null) this.$notify({
            title: 'Ètape '+step,
            message: "Code naf/ape est requis",
            type: 'error'
          });
          else this.nextStep();
          break;
        case 13:

           this.nextStep();
          break;
        case 14:
          if(this.test.formData.contacts.firstName == null) this.$notify({
            title: 'Ètape '+step,
            message: "Prénom est requis",
            type: 'error'
          });
          else if(this.test.formData.contacts.lastName == null) this.$notify({
            title: 'Ètape '+step,
            message: "Nom de famille est requis",
            type: 'error'
          });
          else if(this.test.formData.contacts.email == null) this.$notify({
            title: 'Ètape '+step,
            message: "Email est requise",
            type: 'error'
          });
          else if(this.test.formData.contacts.phone == null) this.$notify({
            title: 'Ètape '+step,
            message: "Numéro de télèphone est requis",
            type: 'error'
          });
          else if(this.test.formData.contacts.position == null) this.$notify({
            title: 'Ètape '+step,
            message: "Position est requise",
            type: 'error'
          });
          else this.showResult();
          break;
        case 15:
          if(!this.test.zoom.generated){
            this.$notify({title: 'Zoom', message: "Vous devez générer un rendez-vous", type: 'error'});
          } else {
            this.nextStep();
          }
        break;
      }
    },

    generateZoomLink(){
      this.test.zoom.generating = true;
      this.test.zoom.generated = true;
      requester.generateZoom(JSON.stringify({cid:this.test.formData.contactID,type:this.test.formData.meetingType}))
      .then(response=>{
        if(!response.data.error){
          this.test.zoom.generating = false;
          this.test.zoom.generated = true;
          this.$notify({title: 'Zoom', message: response.data.message, type: 'success'});
        } else {
          this.test.zoom.generating = false;
          this.test.zoom.generated = false;
          this.$notify({title: 'Zoom', message: response.data.message, type: 'error'});
        }
      })
      .catch(error=>{
        console.log(error);
        this.test.zoom.generating = false;
        this.test.zoom.generated = false;
      });
    },

    closeTest(){
      window.location = '/dashboard'
    }
  },

}
</script>

<style>

</style>
