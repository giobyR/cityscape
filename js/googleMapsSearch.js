function searchMaps(){
    var input=document.getElementById("cercaLuogo");
    var searchBox = new google.maps.places.SearchBox(input);
    //var luogo=new LuogoGoogleMaps(null,null);
    
    // cerca luoghi inviando richieste a google Maps quando l'utente inserisce
    // una parola di ricerca 
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
  
        if (places.length == 0) {
            console.log("impossibile comunicare con google ");
          return;
        }
        //salvo le informazioni sul luogo trovato
        luogo.indirizzo=places.formatted_address;
        luogo.placeID=places.place_id;

        //aggiungo un event listener al pulsante di sottomissione evento
        //per salvare le informazioni sul luogo quando 
        //l'utente invia richiesta di salvataggio evento
        /*
        document.getElementById("submitEvent").addEventListener("submit",function(){
            LuogoGoogleMaps.salvaLuogo(luogo);
        });
        */
    });
    
}
function LuogoGoogleMaps(indirizzo,placeID){
    this.indirizzo=indirizzo;
    this.placeID=placeID;
};
//salvo luogo in database tramite richiesta Ajax
LuogoGoogleMaps.salvaLuogo=function(luogo){
    var url=CaricaEventi.urlOperazioniAggiornamento
                    +"?queryType=21"
                    +"&placeID="+luogo.placeID
                    +"&indirizzo="+luogo.indirizzo;
            var responseFunction=LuogoGoogleMaps.riceviConferma;
            AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
}
//aggiorno la mappa fisica con le informazioni sul luogo 
LuogoGoogleMaps.aggiornaMappa=function(){

}
LuogoGoogleMaps.riceviConferma=function(risposta){
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        console.log("errore nel salvare il luogo");
    }
    if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
        console.log("luogo salvato correttamente");
    }
} 