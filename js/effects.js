
    function searchOnHover(){
        document.getElementById("searchBar").setAttribute("style","opacity:1");
        document.getElementById("searchBar").setAttribute("style","transition:opacity 1s linear");
    }
    function searchOnHoverOut(){
        document.getElementById("searchBar").setAttribute("style","opacity:0");
        document.getElementById("searchBar").setAttribute("style","position:absolute");
    }
    function displayEventOnClick(element){
        //element.addEventListener('click',function(){
            var fratello=element.nextElementSibling;
            if(fratello.style.maxHeight){
                fratello.style.maxHeight=null;
            }else{
                fratello.style.maxHeight=fratello.scrollHeight+'px';
            }
        //});
    }
    function hideEventOnBlur(element){
        var fratello=element.nextSibling;
        console.log("sono dentro hideEvents");
        if(fratello.style.maxHeight){
            console.log("sono nel ciclo per chiudere finestra");
            fratello.style.maxHeight=null;
        }    
    }
    function cambiaActiveNavbarElem(elem){
        console.log("entro nel metodo cambiaActiveNavbarElem");
        var elemConClasse=document.getElementsByTagName('a');
        for(var i=0;i<elemConClasse.length;i++){
            elemConClasse.removeClass("active");
        }
        elem.setAttribute("class","active");
    }

    //serve per disabilitare il tasto di ricerca 
    //se l'utente si trova all'interno di una pagina dove 
    //non è prevista la ricerca 
    function disabilitaSearchImg(){
        var indirizzo=window.location.href;
        var subString="/php/profilo_infoAccount.php";
        switch(true){
            case CaricaEventi.verificaLocationHref("/php/profilo_infoAccount.php"):
                document.getElementById('searchImg').disabled=true;
                break;
            case CaricaEventi.verificaLocationHref("/php/pagina_evento.php"):
                document.getElementById('searchImg').disabled=true;
                break;
            case CaricaEventi.verificaLocationHref("/php/formAggiungiEvento.php"):
                document.getElementById('searchImg').disabled=true;
                break;
            default:
                document.getElementById('searchImg').disabled=false;
                break;
        }
    }
    /*
    function aggiungiListenersPaginaEvento(){
        var referrralSelector=document.querySelector("[name=selezioneReferral]");
        //abilito e disabilito il campo referral solo se l'utente ha un referral da inserire
        referrralSelector.addEventListener("click",function(){
            if(referrralSelector.value=="si"){
                document.getElementById("referral").setAttribute("disabled","false");
            }else{
                document.getElementById("referral").setAttribute("disabled","false");
            }
        })
        document.getElementById('referral').addEventListener('blur',function(){ verificaReferral(".$referral.",".$_SESSION['userID'].")});
        document.getElementById('buttonPartecipa').addEventListener('click',inviaPartecipazione(".$_GET['idEvento'].",".$_SESSION['userID']."));
        document.getElementById('sceltaSI').addEventListener('click',abilitaReferral);
        document.getElementById('sceltaNO').addEventListener('click',abilitaReferral);
    }
    */