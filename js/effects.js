
    /*
    function openSidebar(){
        document.getElementById("sideBar").setAttribute("style","width:250px");
        document.getElementById("main").setAttribute('style','margin-left:250px');
    }
    function closeSidebar(){
        document.getElementById("sideBar").setAttribute("style","width:0");
        document.getElementById("main").setAttribute('style','margin-left:0');
    }
    */
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
        var fratello=element.nextElementSibling;
        if(fratello.style.maxHeight){
            fratello.style.maxHeight=null;
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