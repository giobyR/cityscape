function CaricaEventi(){}
CaricaEventi.tipoConnessione='GET';
CaricaEventi.tipoConnessioneProfiloUtente='POST';
CaricaEventi.urlRichiestaPHP='/php/ajax/caricaEventi.php';
CaricaEventi.urlModificaProfiloUtente='/php/ajax/modificaProfilo.php';
CaricaEventi.urlOperazioniAggiornamento='/php/ajax/operazioniAggiornamento.php';
//parametri da usare per impostare il tipo di interrogazione AJax
CaricaEventi.tipoRichiesta="GET";
CaricaEventi.limiteNumeroEventi=20;
//costanti da usare nella scelta delle query da fare quando si interroga il database
CaricaEventi.EVENTI_PIU_RECENTI=0;
CaricaEventi.EVENTI_PIU_INTERESSANTI=1;
CaricaEventi.CATEGORIA_BAMBINI=6;
CaricaEventi.CATEGORIA_CINEMA=8;
CaricaEventi.CATEGORIA_CONCERTI=9;
CaricaEventi.CATEGORIA_CULTURA=10;
CaricaEventi.CATEGORIA_NIGHTLIFE=11;
CaricaEventi.CATEGORIA_SPORT=12;
CaricaEventi.CATEGORIA_ALTRO=13;
CaricaEventi.EVENTI_INTERESSE_UTENTE=2;
CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE=3;
CaricaEventi.EVENTI_CREATI_UTENTE=4;
CaricaEventi.ACCOUNT_UTENTE=5;
CaricaEventi.AGGIORNA_UTENTE=7;
CaricaEventi.CANCELLA_EVENTO=14;
CaricaEventi.AGGIUNGI_PARTECIPAZIONE=15;
CaricaEventi.CERCA_PAROLA_CHIAVE=18;
CaricaEventi.CERCA_LUOGO=19;
CaricaEventi.CERCA_DATA=20;
//indica se la richiesta ajax e' asincrona oppure no con il server
CaricaEventi.ASYNC_TYPE='true';
//costanti usate dalle risposte ajax per indicare lo stato della risposta
CaricaEventi.SUCCESS_RESPONSE='0';
CaricaEventi.NO_DATA='-1';
CaricaEventi.CURRENT_PAGE_INDEX=1;

CaricaEventi.caricaPrecedente=function(queryType){
    CaricaEventi.CURRENT_PAGE_INDEX++;
    CaricaEventi.loadData(queryType);
}
CaricaEventi.caricaSuccessivo=function(queryType){
    CaricaEventi.CURRENT_PAGE_INDEX--;
    if(CaricaEventi.CURRENT_PAGE_INDEX<=1){
        CaricaEventi.CURRENT_PAGE_INDEX=1;
    }
    CaricaEventi.loadData(queryType);
}
CaricaEventi.loadData=function(queryType){
    /*
    if(queryType==CaricaEventi.ACCOUNT_UTENTE){
        var url=CaricaEventi.urlModificaProfiloUtente+"?queryType="+queryType;
        var responseFunction=CaricaEventi.rispostaAjaxProfiloUtente;
    }else{
        var url=CaricaEventi.urlRichiestaPHP+"?queryType="+queryType+"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi;
        var responseFunction=CaricaEventi.rispostaAjax;
    }
    */
    switch(queryType){
        case CaricaEventi.ACCOUNT_UTENTE:
            var url=CaricaEventi.urlModificaProfiloUtente+"?queryType="+queryType;
            var responseFunction=CaricaEventi.rispostaAjaxProfiloUtente;
            break;
        case CaricaEventi.CATEGORIA_BAMBINI:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_BAMBINI
                    +"&categoria=bambini&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_CINEMA:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_CINEMA
                    +"&categoria=cinema&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    ++"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_CONCERTI:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_CONCERTI
                    +"&categoria=concerti&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_CULTURA:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_CULTURA
                    +"&categoria=cultura&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_NIGHTLIFE:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_NIGHTLIFE
                    +"&categoria=nightlife&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_SPORT:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_SPORT
                    +"&categoria=sport&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.CATEGORIA_ALTRO:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA_ALTRO
                    +"&categoria=altro&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
        case CaricaEventi.EVENTI_CREATI_UTENTE:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.EVENTI_CREATI_UTENTE
                    +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjaxProfiloEventiCreati;
            break;    
        default:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+queryType
                    +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjax;
            break;
    }
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);    
}
//invia richiesta ajax per gestire le categorie utenti
CaricaEventi.insertCategoria=function(categoria){
    var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.CATEGORIA+"&categoria="+categoria+"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi;
    var responseFunction=CaricaEventi.rispostaAjax;
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
}
//invia richiesta Ajax per gestire la modifica profilo utente
CaricaEventi.loadDataProfilo=function(infoUtente){
    var url=CaricaEventi.urlModificaProfiloUtente;
    var responseFunction=CaricaEventi.rispostaAjaxProfiloUtente;
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessioneProfiloUtente,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                infoUtente,
                                responseFunction);
}
CaricaEventi.cercaParola=function(queryType,parolaChiave,tipoRicerca){
    var tipoQuery;
    switch(queryType){
        case CaricaEventi.CERCA_PAROLA_CHIAVE:
            tipoQuery=CaricaEventi.CERCA_PAROLA_CHIAVE;
            break;
        case CaricaEventi.CERCA_LUOGO:
            tipoQuery=CaricaEventi.CERCA_LUOGO;
            break;
        case CaricaEventi.CERCA_DATA:
            tipoQuery=CaricaEventi.CERCA_DATA;
            break;        
    }
    var url=CaricaEventi.urlRichiestaPHP+"?queryType="+tipoQuery+"&"+tipoRicerca+"="+parolaChiave
            +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
            +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
    var responseFunction=CaricaEventi.rispostaAjax;
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
}
//riceve risposta da server con dati utente e aggiorna
//la pagina web con i dati ricevuti
CaricaEventi.rispostaAjaxProfiloUtente=function(risposta){
    var datiUtente;
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        return;
    }
    if((risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE)||(risposta.data !=null)){
        datiUtente=JSON.parse(risposta.data);
        //chiamo la funzione che aggiorna la pagina web del profilo utente
        gestioneDashboard.riempiFormProfilo(datiUtente);
    }
    console.log(datiUtente);
    
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
        gestioneDashboard.refreshData(arrayDati/*JSON.parse(risposta.data)*/);
    }    
}
CaricaEventi.rispostaAjaxProfiloEventiCreati=function(risposta){
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
        gestioneDashboard.refreshDataEventiCreati(arrayDati/*JSON.parse(risposta.data)*/);
    }
}    