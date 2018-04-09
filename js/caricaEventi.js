function CaricaEventi(){}
CaricaEventi.tipoConnessione='GET';
CaricaEventi.urlRichiestaPHP='/php/ajax/caricaEventi.php';
//parametri da usare per impostare il tipo di interrogazione AJax
CaricaEventi.tipoRichiesta="GET";
CaricaEventi.limiteNumeroEventi=20;
//costanti da usare nella scelta delle query da fare quando si interroga il database
CaricaEventi.EVENTI_PIU_RECENTI=0;
CaricaEventi.ASYNC_TYPE='true';
//costanti usate dalle risposte ajax per indicare lo stato della risposta
CaricaEventi.SUCCESS_RESPONSE='0';
CaricaEventi.NO_DATA='-1';

CaricaEventi.loadData=function(queryType){
    var url=CaricaEventi.urlRichiestaPHP+"?queryType="+queryType+"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi;
    var responseFunction=CaricaEventi.rispostaAjax;
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
}
CaricaEventi.rispostaAjax=function(risposta){
    //console.log(risposta);
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        //crea lista eventi vuota nella pagina principale
        return;
    }
    if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
        var arrayDati=new Array();
        for(var i=0;i<risposta.data.length;i++){
            if(risposta.data[i]!==false)
                arrayDati[i]=JSON.parse(risposta.data[i]);
        }
        console.log(arrayDati);
        gestioneEvento.refreshData(arrayDati/*JSON.parse(risposta.data)*/);
    }
}