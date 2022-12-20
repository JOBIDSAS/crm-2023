function convertDate(date) {
  var event = new Date(date).toISOString();
  event = event.split("T")[0];
  event = event.split("-");
  event = event.join("");
  return event;
}

function makeIcsFile(uid,mid,zlink,pass,date,dstr,dend,ttl,desc) {
  var event =
    "BEGIN:VCALENDAR\n" +
    "CALSCALE:GREGORIAN\n" +
    "METHOD:PUBLISH\n" +
    "PRODID:-//Test Cal//EN\n" +
    "VERSION:2.0\n" +
    "BEGIN:VEVENT\n" +
    "UID:"+uid+"'\n" +
    "DTSTART;VALUE=DATE:" +
    convertDate(dstr) +
    "\n" +
    "DTEND;VALUE=DATE:" +
    convertDate(dend) +
    "\n" +
    "SUMMARY:" +
    ttl +
    "\n" +
    "DESCRIPTION:" +
    desc +" "+" "+mid+" "+zlink+" "+pass+
    "\n" +
    "END:VEVENT\n" +
    "END:VCALENDAR";
  var blob = new Blob([event], {type: "text/plain;charset=utf-8"});
  FileSaver.saveAs(blob, "calendar.ics");
}

var FileSaver = require('file-saver');
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const uid = urlParams.get('uid')
const mid = urlParams.get('mid')
const zlink = urlParams.get('zlink')
const pass = urlParams.get('pass')
const date = urlParams.get('date')
const dstr = urlParams.get('dstr')
const dend = urlParams.get('dend')
const ttl = urlParams.get('ttl')
const desc = urlParams.get('desc')

document.addEventListener('load',makeIcsFile(uid,mid,zlink,pass,date,dstr,dend,ttl,desc))