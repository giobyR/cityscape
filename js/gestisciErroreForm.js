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
gestisciErrore.verificaData=function(campoDoveSegnalare,campoDaVerificare){
    var re=/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/;
    var data=campoDaVerificare;//document.getElementById('dataEvento');
    var err=campoDoveSegnalare;//document.getElementById('err_data');
    var vm;
    if((data.value !='')&&(val=data.value.match(re))){
            //giorno fra 1 e 31 
            if(val[3]<1 || val[3]>31){
                vm="il giorno inserito non e' valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
            }
            //mese fra 1 e 12
            if(val[2]<1 || val[2]>12){
                vm="il mese inserito non e'valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
            }
            //anno  inferiore a quello odierno
            if(val[1]<(new Date().getFullYear())){
                vm="l'anno inserito non e'valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
            }
    }else{
        vm="inserire la data nel formato aaaa/mm/gg";
        data.setCustomValidity(vm);
        gestisciErrore.segnalaErrore(err,data);
    }     
}    
