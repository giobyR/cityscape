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
    var datiDaElaborare=new Array();
    //funzione usata per convertire i dati da inviare in stringa
    //var datiInviati=JSON.stringify(data); 
    if(xmlHttp===null){
        window.alert("il browser usato non supporta Ajax!");
        return;
    }
    xmlHttp.open(tipoRichiesta,url,isAsync);
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            if(xmlHttp.status==200){
                console.log(xmlHttp.responseText);
                datiRicevuti=JSON.parse(xmlHttp.responseText);
                console.log(datiRicevuti);
                //datiDaElaborare[0]=JSON.parse(datiRicevuti.data[0]);
                //console.log(datiDaElaborare);
                responseFunction(datiRicevuti);
            }
        }
    }
    if(tipoRichiesta=="POST"){
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var datiDaInviare=JSON.stringify(data);
        xmlHttp.send("str="+datiDaInviare);
    }else{
        xmlHttp.send();
    }
}