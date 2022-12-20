<template>
  <div class="calendar_container">
    <div class="calendar_wrapper">
      <template>
        <v-row class="fill-height">
          <v-col>

            <v-sheet height="64">
              <v-toolbar flat>
                <v-btn color="#111D5E" dark small class="mr-4" @click="setToday">Aujourd'hui</v-btn>
                <v-btn fab text small color="grey darken-2" @click="prev">
                  <v-icon small>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn fab text small color="grey darken-2" @click="next">
                  <v-icon small>mdi-chevron-right</v-icon>
                </v-btn>
                <v-toolbar-title v-if="$refs.calendar">
                  {{ $refs.calendar.title }}
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-menu bottom right>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn color="#111D5E" dark small v-bind="attrs" v-on="on">
                      <span>{{ typeToLabel[type] }}</span>
                      <v-icon right>mdi-menu-down</v-icon>
                    </v-btn>
                  </template>
                  <v-list color="#111D5E" dark small>
                    <v-list-item @click="type = 'day'">
                      <v-list-item-title>Jours</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = 'week'">
                      <v-list-item-title>Semaines</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = 'month'">
                      <v-list-item-title>Mois</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = '4day'">
                      <v-list-item-title>4 Jours</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </v-toolbar>
            </v-sheet>

            <v-sheet height="600">
              <v-calendar
                ref="calendar"
                v-model="focus"
                color="success"
                :events="events"
                event-more-text="Plus"
                :type="type"
                locale="fr"
                @click:event="showEvent"
                @click:more="showMoreEvent"
                @click:date="viewDay"
              ></v-calendar>
              <v-menu
                v-model="selectedOpen"
                :close-on-content-click="false"
                :activator="selectedElement"
                offset-x>
                <v-card color="grey lighten-4" min-width="350px" flat>
                  <v-toolbar :color="selectedEvent.color" dense flat dark>
                    <v-toolbar-title style="font-size:14px">{{selectedEvent.name}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn @click="selectedOpen = false" color="white" icon>
                      <v-icon >mdi-calendar-remove</v-icon>
                    </v-btn>
                  </v-toolbar>
                  <v-card-text>
                    <v-row dense>
                      <v-col cols="6">Date :</v-col>
                      <v-col cols="6">{{selectedEvent.start}}</v-col>
                      <!-- <v-col cols="6">Type :</v-col>
                      <v-col cols="6">{{selectedEvent.details.type}}</v-col>
                      <v-col cols="6">Zoom id :</v-col>
                      <v-col cols="6">{{selectedEvent.details.id}}</v-col>
                      <v-col cols="6">Lien zoom :</v-col>
                      <v-col cols="6">{{selectedEvent.details.link}}</v-col>
                      <v-col cols="6">Mot de passe :</v-col>
                      <v-col cols="6">{{selectedEvent.details.password}}</v-col> -->
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-menu>
            </v-sheet>

          </v-col>
        </v-row>
      </template>
    </div>
  </div>
</template>

<script>
import requester from "../../modules/requester";
export default {
  data() {
    return {
      focus: '',
      type: 'month',
      typeToLabel: {
        month: 'Mois',
        week: 'Semaines',
        day: 'Jours',
        '4day': '4 jours',
      },
      selectedEvent: {},
      selectedElement: null,
      selectedOpen: false,
      events: [],
    }
  },
  created:function(){
    this.getCalendarEvents();
  },
  mounted:function() {
    this.$refs.calendar.checkChange()
  },
  methods: {

    prev () {
      this.$refs.calendar.prev()
    },
    next () {
      this.$refs.calendar.next()
    },

    getCalendarEvents(){
      requester.calendarEventsGet()
      .then(response=>{
        response.data.events.forEach(event => {
          this.events.push({
            name:event.title,
            start:event.date,
            color:event.color,
          })
        });
      })
      .catch(error=>console.log(error))
    },

    setToday (event) {
      this.focus = ''
    },

    showMoreEvent(event){
      
    },
    viewDay (event) {
      /* this.events.push({
        name: "test event add on in calendar",
        start: event.date+"T23:59:59",
        end: event.date,
        color: "red",
        timed: "12:00",
        details:"aaa"
      }) */
    },

    getEventColor (event) {
      return event.color
    },
    
    async showEvent ({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event
        this.selectedElement = nativeEvent.target
        console.log(this.selectedEvent)
        requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
      }

      if (this.selectedOpen) {
        this.selectedOpen = false
        requestAnimationFrame(() => requestAnimationFrame(() => open()))
      } else {
        open()
      }

      nativeEvent.stopPropagation()
    },

    /*updateRange ({ start, end }) {
      const events = []
      const min = new Date(`${start.date}T00:00:00`)
      const max = new Date(`${end.date}T23:59:59`)
      const days = (max.getTime() - min.getTime()) / 86400000
      const eventCount = this.rnd(days, days + 20)

      for (let i = 0; i < eventCount; i++) {
        const allDay = this.rnd(0, 3) === 0
        const firstTimestamp = this.rnd(min.getTime(), max.getTime())
        const first = new Date(firstTimestamp - (firstTimestamp % 900000))
        const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
        const second = new Date(first.getTime() + secondTimestamp)

        events.push({
          name: this.names[this.rnd(0, this.names.length - 1)],
          start: first,
          end: second,
          color: this.colors[this.rnd(0, this.colors.length - 1)],
          timed: !allDay,
        })
      }
      this.events = events
    },
    rnd (a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a
    }, */
  },
}
</script>

<style>

</style>