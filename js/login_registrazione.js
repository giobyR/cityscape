    
    function segnalaErrore(campoErrore,trigger){
        //campoErrore indica dove segnalare l'errore
        //trigger indica l'elemento del form che non rispetta i vincoli di validità
        if(!trigger.checkValidity()){
            campoErrore.innerHTML=trigger.validationMessage;
        }else{
            campoErrore.innerHTML="";
            trigger.setCustomValidity("");
        }
    }
    function verificaCampoNullo(campoDoveSegnalare,campoDaVerificare){
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
    function validaNome(){
        var nome=document.getElementById("nome")
        var campoErr=document.getElementById("errNome");
        verificaCampoNullo(campoErr,nome);
    }

    function validaCognome(){
        var cognome=document.getElementById('cognome');
        var errCogn=document.getElementById('errCognome');
        verificaCampoNullo(errCogn,cognome);
    }
    
    function validaEmail(){
        campoEmail=document.getElementById('email');
        errEm=document.getElementById('errEmail');
        var vm="email non valida!";
        //regular expression che rispetta le specifiche google per convalidare una mail
        var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //verifico che la email non abbia valori nulli
        verificaCampoNullo(errEm,campoEmail);
        //verifico che la mail abbia il formato giusto
        if(!re.test(String(campoEmail.value).toLowerCase())){
            campoEmail.setCustomValidity(vm);
            segnalaErrore(errEm,campoEmail);
        }else{
            errEm.innerHTML="";
            campoEmail.setCustomValidity("");
        }
    }  
    function validaPwd(){
        var campoPwd=document.getElementById('pwd');
        var errPwd=document.getElementById('errPwd');
        //regular expression per verificare che la password abbia almeno una 
        //lettera minuscola,maiuscola e una cifra
        var re=/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
        var vm1="La password deve avere almeno una lettera maiuscola,minuscola e una cifra!";
        var vm3="la password deve essere lunga almeno 8 caratteri!";
        var vm2="password non valida!";
        verificaCampoNullo(errPwd,campoPwd);
        if((campoPwd.value.length < 8)){     //controllo lunghezza password
            campoPwd.setCustomValidity(vm3);
            segnalaErrore(errPwd,campoPwd);
        }else if(!re.test(campoPwd.value)){ // controllo validita caratteri inseriti 
            campoPwd.setCustomValidity(vm1);
            segnalaErrore(errPwd,campoPwd);
        }else{
            errPwd.innerHTML="";
            campoPwd.setCustomValidity("");
        }

    }
    function validaRpwd(){
        var campoRpwd=document.getElementById('Rpwd');
        var campoPwd=document.getElementById('pwd');
        var errRpwd=document.getElementById('errRpwd');
        var vm="la password deve essere uguale!"
        verificaCampoNullo(errRpwd,campoRpwd);
        if(campoRpwd.value!=campoPwd.value){     //controllo che le due password siano uguali
            campoRpwd.setCustomValidity(vm);
            segnalaErrore(errRpwd,campoRpwd);
        }else{
            errRpwd.innerHTML="";
            campoRpwd.setCustomValidity("");
        }    
    }
    
    function submitControl(){
        var form=document.querySelector('form[name=formRegistrazione]');
        if(form.checkValidity()){
            form.submitButton.disabled=false
        }else{
            form.submitButton.disabled=true;
            //form.elements["checkCondizioniUso"].checked=false;
        }
    }
    /*
    function ajaxRichiesta(whereToSubmit,data){
        var submit=document.getElementById("submitButton");
        var richiesta;
    
        if(window.XMLHttpRequest){
            richiesta=new XMLHttpRequest();
        }else if(window.ActiveXObject){
            richiesta=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if(richiesta !=undefined){
            try{
                richiesta.open("POST",whereToSubmit,true);
            }catch(errore){
                alert("Impossibile inviare la richiesta al server"+errore.message);
                return false;
            }
            richiesta.send(data);
            if(richiesta.readyState==4){
                if(richiesta.status==200){
                    return richiesta.responseText;
                }else{
                    return "ReqERR:"+richiesta.status+" "+richiesta.statusText;
                }
            }
        }
    }
    */
    function esitoRegistrazione(data){
        alert(data);
    }
    /*
    function ajaxSubmit(){
        var formRegistrazione=document.querySelector('form[name=formRegistrazione]');
        //preparo la stringa per richiesta ajax
        var utente={
            nome:formRegistrazione.elements["nome"].value,
            cognome:formRegistrazione.elements["cognome"].value,
            email:formRegistrazione.elements["email"].value,
            password:formRegistrazione.elements["pwd"].value
        };
        
        var phpPath="../php/gestione_registrazione.php";
        var responseFunction=this.esitoRegistrazione;
        var tipoRichiesta="POST";
        AjaxManager.inviaRichiesta(tipoRichiesta,phpPath,true,utente,responseFunction);
    }
    */
function forumRegistrazioneHandler(){
//catturo eventi che riguardano il form di registrazione
    var formRegistrazione=document.querySelector('form[name=formRegistrazione]');
    formRegistrazione.onload=formRegistrazione.reset();
    formRegistrazione.elements["nome"].onblur=validaNome;
    formRegistrazione.elements["cognome"].onblur=validaCognome;
    formRegistrazione.elements["email"].onblur=validaEmail;
    formRegistrazione.elements["pwd"].onblur=validaPwd;
    formRegistrazione.elements["Rpwd"].onblur=validaRpwd;
    formRegistrazione.onchange=submitControl;

    //formRegistrazione.elements["submitButton"].onclick=ajaxSubmit;

    //alert(risultato);                
    //formRegistrazione.elements["resetButton"].onclick=reset;

}
function forumLoginHandler(){
    //catturo eventi che riguardano il form di login
    var formLogin=document.querySelector('form[name=formLogin]');
    formLogin.onload=formLogin.reset();
    formLogin.elements["email"].onblur=validaEmail;
    formLogin.elements["pwd"].onblur=validaPwd;
}
