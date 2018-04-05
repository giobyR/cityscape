function gestisciErrore(){}

gestisciErrore.segnalaErrore=function(campoErrore,trigger){
    //campoErrore indica dove segnalare l'errore
    //trigger indica l'elemento del form che non rispetta i vincoli di validità
    if(!trigger.checkValidity()){
        campoErrore.innerHTML=trigger.validationMessage;
    }else{
        campoErrore.innerHTML="";
        trigger.setCustomValidity("");
    }
}
gestisciErrore.verificaCampoNullo=function(campoDoveSegnalare,campoDaVerificare){
    var vm="il campo non può essere vuoto!";
    if(campoDaVerificare.value==""){
        //il campo è nullo 
        campoDaVerificare.setCustomValidity(vm);
        segnalaErrore(campoDoveSegnalare,campoDaVerificare);
    }else{
        campoDoveSegnalare.innerHTML="";
        campoDaVerificare.setCustomValidity("");
    }
}