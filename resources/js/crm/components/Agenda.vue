<template>
  <div>
      <FullCalendar style="background:white; padding:10px; border-radius:10px" :options="calendarOptions"/>
      <template>
        <div class="text-center">
          <v-dialog v-model="addEventDialog.isOpen" width="350">
            <v-card>
              <v-card-title>
                <header class="m-0">Un nouvel événement</header>
              </v-card-title>
              <v-card-text>
                <v-row dense>
                  <v-col class="mb-2" cols="12" md="12" sm="12">
                    <el-input 
                      placeholder="Titre d'événement" 
                      v-model="addEventDialog.event.title">
                    </el-input>
                  </v-col>
                  <v-col class="mb-2" cols="12" md="12" sm="12">
                    <el-date-picker style="width:100%"
                      v-model="addEventDialog.event.date"
                      type="date"
                      placeholder="Choississez un jour">
                    </el-date-picker>
                  </v-col>
                  <v-col class="mb-2" cols="12" md="12" sm="12">
                    <el-time-select style="width:100%"
                      placeholder="Choisissez un temps"
                      :picker-options="{
                        start: '04:00',
                        step: '00:15',
                        end: '20:00'
                      }"
                      v-model="addEventDialog.event.time">
                    </el-time-select>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="#CE1212" small outlined text @click="addEventDialog.isOpen = false">Annuler</v-btn>
                <v-btn color="#038418" :loading="addEventDialog.isLoading" :disabled="addEventDialog.isLoading" small outlined text v-on:click="addCalendarEvent(addEventDialog.event)">Confirmer</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
      </template>
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';
import requester from "../modules/requester";

export default { 
  components:{FullCalendar},
  props:{
    contactName:String,
    contactID:Number,
  },
  data(){
    return{
      calendarOptions: {
        plugins: [ 
          dayGridPlugin,
          interactionPlugin,
          timeGridPlugin,
          listPlugin 
        ],
        headerToolbar: {
          left: "dayGridMonth",
          center: "title",
          right: "prev,next today",
        },
        buttonText: {
          today: "Aujourd'hui",
          month: "Mois",
          week: "Semaine",
          day: "Jour",
          list: "liste"
        },
        locale:"fr",
        initialView: "dayGridMonth",
        editable: false,
        selectable: true,
        selectMirror: true,
        droppable: false,
        disableDragging:false,
        dayMaxEvents: true,
        weekends: true,
        events: [],
        dateClick: this.handleDateClick,
        eventClick: this.handleEventclick,
      },
      addEventDialog:{
        isOpen:false,
        isLoading:false,
        event:{
          title:(this.contactName == "null null")?null:this.contactName,
          date:null,
          time:null,
          color:"#111D5E",
        }
      },
      editEventDialog:{
        isOpen:false,
        isLoading:false,
      }
    }
  },
  beforeMount:function () {
    this.getCalendarEvents()
  },
  methods:{
    getCalendarEvents(){
      requester.getEvents()
      .then((response) => {
        response.data.events.forEach(event => {
          this.calendarOptions.events.push({
            id:event.id,
            title: event.title,
            date: event.date,
            color: event.color,
            extendedProps:{
              cid: event.contacts_id,
              description: event.description,
            }
          })
        });

      })
      .catch((error) => console.log(error));
    },

    handleDateClick: function(clickInfo) {
      this.addEventDialog.event.date = clickInfo.dateStr
      this.addEventDialog.isOpen = true;
    },

    addCalendarEvent(event){
      this.addEventDialog.isLoading = true;
      var eventForm = new Map();
      eventForm["cid"] = this.contactID;
      eventForm["title"] = event.title;
      eventForm["desc"] = null;
      eventForm["date"] = event.date;
      eventForm["time"] = event.time;
      requester.addEvents(JSON.stringify(eventForm))
      .then(response=>{
        if(!response.data.error){

          if(response.data.type == "edit"){
            let findEvent = this.calendarOptions.events.findIndex((element) => element.id == response.data.event.id)
            this.calendarOptions.events.splice(findEvent,1);
          }

          this.calendarOptions.events.push({
            id: response.data.event.id,
            title: response.data.event.title,
            date: response.data.event.date,
            color: response.data.event.color,
            extendedProps:{
              cid: response.data.event.contacts_id,
              description: response.data.event.description,
            }
          });

          this.$notify({title: 'Événement', message: response.data.message, type: 'success'});

        }

        this.addEventDialog.isLoading = false;
        this.addEventDialog.isOpen = false;
      })
      .catch(error=>{
        this.addEventDialog.isLoading = false;
        this.addEventDialog.isOpen = false;
        console.log(error);
      })
    },

    handleEventclick(){
      this.editEventDialog.isOpen = true;
    },

    /*deleteCalendarEvents(event) {
      if (confirm(`Vous étes sur de supprimer l'événement '${event.event.title}'`)) {
        api.deletEvent(event.event.id)
        .then(response =>{
          if(!response.data.error){
            this.handleToast(response.data.message, "success")
            let findEvent = this.calendarOptions.events.findIndex((element) => element.id == event.event.id)
            this.calendarOptions.events.splice(findEvent,1);
          } else {
            this.handleToast(response.data.message, "error")
          }
        })
        .catch(error => {
          this.handleToast(error, "error")
        });
      }
    },

    addCalendarEvent(event){
      var dataEventEntry = new Map();
      dataEventEntry["clientId"] = this.clientId;
      dataEventEntry["title"] = event.title;
      dataEventEntry["date"] = event.date;
      dataEventEntry["time"] = event.time.hours+":"+event.time.minutes;
      dataEventEntry["color"] = event.color;
      api.addEvent(JSON.stringify(dataEventEntry))
      .then(response=>{
        if(!response.data.error){
          this.handleToast(response.data.message, "success")
          this.addDataEvent(response.data.event)
          this.zoomMeeting(response.data.event.date+" "+response.data.event.time)
        } else {
          this.handleToast(response.data.message, "error")
        }
      })
      .catch(error => {
          this.handleToast(error, "error")
      });
    },

    addDataEvent(dataEvent){
      this.calendarOptions.events.push({
        id:dataEvent.id,
        title:dataEvent.title,
        date:dataEvent.date,
        color:dataEvent.color,
        extendedProps:{
          clientId:null,
          clientName:null,
          time:dataEvent.time,
          description:null,
        }
      })
    },*/

    
  }
}
</script>

<style>

</style>