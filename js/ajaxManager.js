function AjaxManager(){};
//server per creare una connesione con il server
//usata per inviare le richieste del client
AjaxManager.creaConnessione=function(){
    var xmlHttp = null;
		try { 
			xmlHttp = new XMLHttpRequest(); 
		} catch (e) {
			try { 
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); //IE (recent versions)
			} catch (e) {
				try { 
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); //IE (older versions)
				} catch (e) {
					xmlHttp = null; 
				}
			}
		}
		return xmlHttp;
}

AjaxManager.inviaRichiesta=function(tipoRichiesta,url,isAsync,data,responseFunction){
    var xmlHttp=AjaxManager.creaConnessione();
    var datiRicevuti;
    //funzione usata per convertire i dati da inviare in stringa
    var datiInviati=JSON.stringify(data); 
    if(xmlHttp===null){
        window.alert("il browser usato non supporta Ajax!");
        return;
    }
    if(tipoRichiesta=="GET"){   //invio i dati tramite url
        url=url+"?str="+datiInviati;
        xmlHttp.open(tipoRichiesta,url,isAsync);
    }else{
        alert("sono in post");
        xmlHttp.open(tipoRichiesta,url,isAsync);
    }
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            if(xmlHttp.status==200){
                console.log(xmlHttp.responseText);
                datiRicevuti=JSON.parse(xmlHttp.responseText);
                responseFunction(datiRicevuti);
            }
        }
    }
    if(tipoRichiesta=="POST"){
        //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        datiInviati="str="+datiInviati;
        alert(datiInviati);
        alert("sto inviando i dati")
        xmlHttp.send(datiInviati);
    }else{
        xmlHttp.send();
    }
}