function gestisciErrore(){}

gestisciErrore.segnalaErrore=function(campoErrore,trigger){
    //campoErrore indica dove segnalare l'errore
    //trigger indica l'elemento del form che non rispetta i vincoli di validità
    if(!trigger.checkValidity()){
        campoErrore.innerHTML=trigger.validationMessage;
    }else{
        campoErrore.innerHTML="";
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
    val=data.value.match(re);
    if((data.value !='')&&(val)){
            //anno  inferiore a quello odierno
            if(val[1]<(new Date().getFullYear())){
                vm="l'anno inserito non e'valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
                return;
            }
            //mese fra 1 e 12
            if(val[2]<1 || val[2]>12){
                vm="il mese inserito non e'valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
                return;
            }
            //giorno fra 1 e 31 
            if(val[3]<1 || val[3]>31){
                vm="il giorno inserito non e' valido!";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
                return;
            }
            //verifica che la data sia successiva ad oggi
            if((val[1]==(new Date().getFullYear()))&&(val[2]==(new Date().getMonth()))&&(val[3]<=(new Date().getDate()))){
                vm="la data inserita deve essere successiva a oggi !";
                data.setCustomValidity(vm);
                gestisciErrore.segnalaErrore(err,data);
                return;
            }
    }else{
        vm="inserire la data nel formato aaaa/mm/gg";
        data.setCustomValidity(vm);
        gestisciErrore.segnalaErrore(err,data);
        return;
    }
    data.setCustomValidity("");
    gestisciErrore.segnalaErrore(err,data);     
}    
