const axios = require("axios");
const jQuery = require('jquery');
var $ = jQuery;
window.$ = $;
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const userID = urlParams.get('user')
let eventTitle = null

let axiosInstance = axios.create({
  baseURL: "http://localhost/",
  headers: { 'content-type': 'application/json' },
  responseType:'json',
});

document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');
  let eventEditor = document.getElementById("eventEditor")
  let eventName = document.getElementById("eventName")
  let eventDate = document.getElementById("eventDate")
  let eventTime = document.getElementById("eventTime")
  let eventCancel = document.getElementById("eventCancel")
  let eventConfirm = document.getElementById("eventConfirm")

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale:"fr",
    editable: true,
    selectable: true,

    selectConstraint: {
    },

    selectMirror: true,
    droppable: false,
    dayMaxEvents: true,
    weekends: true,
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
    
    events:[],

    dateClick: function(info) {
      eventEditor.style.display = "block";
      eventDate.value = info.dateStr;
      eventName.value = eventTitle;
    },
    /* eventClick: function(info){
      info.event.remove()
    }, */
  });

  calendar.render();
  getEvents();

  function getEvents() { 
    calendar.removeAllEvents();
    axiosInstance.get("mail/change/events/all")
    .then((response)=>{
      console.log(response.data)
      response.data.events.forEach(event => {
        if(event.contacts_id == userID){
          eventTitle = event.title;
          calendar.addEvent({
            id:event.id,
            title: event.title,
            date:event.date,
            color:"#f39c12",
            extendedProps:{
              clientId:event.clients_id,
              time:event.time,
              description:event.description,
            }
          })
        } else {
          calendar.addEvent({
            id:event.id,
            title:"Indisponible",
            date:event.date,
            color:"gray",
            extendedProps:{
              clientId:event.clients_id,
              time:event.time,
              description:event.description,
            }
          })
        }
      });
    }).catch((error)=>console.log(error));
  }

  eventCancel.addEventListener("click",function(){
    eventEditor.style.display = "none";
  })

  eventConfirm.addEventListener("click",function(){
    title = eventTitle;
    date = eventDate.value;
    time = eventTime.value;
    axiosInstance.post("mail/change/events/update",JSON.stringify({id:userID,title:title,date:date,time:time}))
      .then(response=>{
        if(!response.data.error){
          getEvents();
          toastr.success(response.data.message, "Evénement")
          eventEditor.style.display = "none";
        } else {
          toastr.error(response.data.message, "Evénement")
          eventEditor.style.display = "none";
        }
      })
      .catch(error=>console.log(error));
  });

});


