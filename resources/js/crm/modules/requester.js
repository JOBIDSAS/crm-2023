import axios from "axios";

let axiosInstance = axios.create({
    baseURL:"http://crm.cpn-aide-aux-entreprises.com/api/",
    headers: { 'content-type': 'application/json' },
    responseType:'json',
});

let api = () => {  
    let token = localStorage.getItem("token");
    if(token) axiosInstance.defaults.headers.common["Authorization"] = "Bearer "+token;
    return axiosInstance;
};

export default {

    

    signIn(formData){
        return api().post("sign/in",formData)
    },
    signUp(formData){
        return api().post("sign/up",formData)
    },
    signData(){
        return api().get("sign/data")
    },
    signout(){
        return api().get("sign/out");
    },

    //--------- test data ---------//
    activitiesGet(){
        return api().get("test/activities/get")
    },
    transitionsGet(){
        return api().get("test/transitions/get")
    },
    serviceTurnover(val){
        return api().get("test/service/turnover/"+val[0]+"/"+val[1])
    },
    comapnySiren(siren){
        return api().get("test/company/siren/"+siren)
    },
    
    regionalGrant(region,budget,naf){
        return api().get("test/grants/region/"+region+"/"+budget+"/"+naf)
    },
    cpnGrant(service,budget){
        return api().get("/test/grants/cpn/"+service+"/"+budget)
    },
    saveContact(formData){
        return api().post("/test/contact/save", formData)
    },
    getEvents(){
        return api().get("test/events/get")
    },
    addEvents(formData){
        return api().post("test/events/add",formData)
    },
    generateZoom(cid){
        return api().post("test/zoom/generate",cid)
    },
    confirmContact(contactData){
        return api().post("test/contact/confirm",contactData)
    },
    saveTimer(timer){
        return api().post("test/timer/save",timer);
    },

    //--------- leads data ---------//
    getContactsLeads(){
        return api().get("leads/contacts/all")
    },

    rensendConfirmationMail(data){
        return api().post("leads/email/resend",data)
    },

    //--------- supervisor data ---------//
    getClients(){
        return api().get("supervisor/clients/get")
    },

    //--------- calendar data ---------//

    calendarEventsGet(){
        return api().get("calendar/events/get")
    },

    //--------- profile data ---------//
    saveImage(img){
        return api().post("profile/image/save", img);
    }
}