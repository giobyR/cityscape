function CaricaEventi(){}
CaricaEventi.tipoConnessione='GET';
CaricaEventi.tipoConnessioneProfiloUtente='POST';
CaricaEventi.urlRichiestaPHP='/php/ajax/caricaEventi.php';
CaricaEventi.urlModificaProfiloUtente='/php/ajax/modificaProfilo.php';
CaricaEventi.urlOperazioniAggiornamento='/php/ajax/operazioniAggiornamento.php';
//variabile usata per salvare l'array contenente gli eventi
//restituiti dalla richeista Ajax
CaricaEventi.arrayEventi=new Array();
CaricaEventi.altriEventiDaCaricare=false;
CaricaEventi.isAdmin=false;
CaricaEventi.toggleButton=0;
//parametri da usare per impostare il tipo di interrogazione AJax
CaricaEventi.tipoRichiesta="GET";
CaricaEventi.limiteNumeroEventi=9;
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
CaricaEventi.EVENTI_CREATI_UTENTE_ADMIN=25;
CaricaEventi.ACCOUNT_UTENTE=5;
CaricaEventi.AGGIORNA_UTENTE=7;
CaricaEventi.CANCELLA_EVENTO=14;
CaricaEventi.AGGIUNGI_PARTECIPAZIONE=15;
CaricaEventi.AGGIUNGI_INTERESSE=16;
CaricaEventi.CERCA_PAROLA_CHIAVE=18;
CaricaEventi.CERCA_LUOGO=19;
CaricaEventi.CERCA_DATA=20;
CaricaEventi.TOGLI_SEGNALAZIONE=22;
CaricaEventi.SEGNALA_EVENTO=23;
//indica se la richiesta ajax e' asincrona oppure no con il server
CaricaEventi.ASYNC_TYPE='true';
//costanti usate dalle risposte ajax per indicare lo stato della risposta
CaricaEventi.SUCCESS_RESPONSE='0';
CaricaEventi.NO_DATA='-1';
CaricaEventi.CURRENT_PAGE_INDEX=1;

CaricaEventi.caricaSuccessivo=function(queryType){
    CaricaEventi.CURRENT_PAGE_INDEX++;
    document.getElementById('numeroPagina').innerHTML='Pagina '+CaricaEventi.CURRENT_PAGE_INDEX;
    CaricaEventi.loadData(queryType);
}
CaricaEventi.caricaPrecedente=function(queryType){
    CaricaEventi.CURRENT_PAGE_INDEX--;
    if(CaricaEventi.CURRENT_PAGE_INDEX<=1){
        CaricaEventi.CURRENT_PAGE_INDEX=1;
    }
    document.getElementById('numeroPagina').innerHTML='Pagina '+CaricaEventi.CURRENT_PAGE_INDEX;
    CaricaEventi.loadData(queryType);
}
CaricaEventi.loadData=function(queryType){
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
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
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
            CaricaEventi.isAdmin=false; //serve per notificare se sono admin o meno per la ricerca
            break;    
        case CaricaEventi.EVENTI_CREATI_UTENTE_ADMIN:
            var url=CaricaEventi.urlRichiestaPHP+"?queryType="+CaricaEventi.EVENTI_CREATI_UTENTE_ADMIN
                    +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
                    +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi;
            var responseFunction=CaricaEventi.rispostaAjaxProfiloEventiCreatiAdmin;
            CaricaEventi.isAdmin=true;
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
    //serve per disabilitare il tasto di ricerca 
    //se l'utente si trova all'interno di una pagina dove 
    //non è prevista la ricerca  
    disabilitaSearchImg();                                
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

//invia richiesta Ajax per la ricerca di un determinato evento
//tipoRicerca puo valere 'parolaChiave','luogo' oppure 'data'
CaricaEventi.cercaParola=function(queryType,parolaChiave,tipoRicerca){
    var tipoQuery;//indica se cerco parola chiave,luogo o data
    var tipoEvento;//indica il tipo di eventi che ricerco nel database
    var responseFunction; //indica il tipo di funzione di risposta Ajax usare
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
    var arrayQuery=this.trovaTipoQuery();
    if(arrayQuery.length==1){
        tipoEvento=arrayQuery.pop();
        var url=CaricaEventi.urlRichiestaPHP+"?queryType="+tipoQuery+"&"+tipoRicerca+"="+parolaChiave
            +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
            +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi
            +"&tipoRicerca="+tipoEvento;
        console.log(url);    
    }else{
        var categoria=arrayQuery.pop();
        tipoEvento=arrayQuery.pop();
        var url=CaricaEventi.urlRichiestaPHP+"?queryType="+tipoQuery+"&"+tipoRicerca+"="+parolaChiave
            +"&limiteNumeroEventi="+CaricaEventi.limiteNumeroEventi
            +"&offset="+(CaricaEventi.CURRENT_PAGE_INDEX-1)*CaricaEventi.limiteNumeroEventi
            +"&tipoRicerca="+tipoEvento
            +"&categoria="+categoria;
    }    
    //seleziono la funzione di risposta
    switch(tipoEvento){
        case CaricaEventi.EVENTI_CREATI_UTENTE:
            responseFunction=CaricaEventi.rispostaAjaxProfiloEventiCreati;
            break;
        case CaricaEventi.EVENTI_CREATI_UTENTE_ADMIN:
            responseFunction=CaricaEventi.rispostaAjaxProfiloEventiCreatiAdmin;
            break;        
        default:
            responseFunction=CaricaEventi.rispostaAjax;
            break;
    }        
    AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
}
CaricaEventi.verificaLocationHref=function(address){
    var url=window.location.href;
    console.log(url);
    if(url.indexOf(address)==-1)
        return false;
    return true;    
}
CaricaEventi.trovaTipoQuery=function(){
    var tipoQuery=new Array();
    //in questo array salvo il numero del tipo di query da restituire e la categoria se esiste
    //resituisco tale array
    switch(true){
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiRecenti.php"):
            tipoQuery.push(CaricaEventi.EVENTI_PIU_RECENTI);
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPiuInteressanti.php"):
            tipoQuery.push(CaricaEventi.EVENTI_PIU_INTERESSANTI);
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=bambini"):
            tipoQuery.push(CaricaEventi.CATEGORIA_BAMBINI);
            tipoQuery.push('bambini');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=cinema"):
            tipoQuery.push(CaricaEventi.CATEGORIA_CINEMA);
            tipoQuery.push('cinema');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=concerti"):
            tipoQuery.push(CaricaEventi.CATEGORIA_CONCERTI);
            tipoQuery.push('concerti');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=cultura"):
            tipoQuery.push(CaricaEventi.CATEGORIA_CULTURA);
            tipoQuery.push('cultura');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=nightlife"):
            tipoQuery.push(CaricaEventi.CATEGORIA_NIGHTLIFE);
            tipoQuery.push('nightlife');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=sport"):
            tipoQuery.push(CaricaEventi.CATEGORIA_SPORT);
            tipoQuery.push('sport');
            break;
        case CaricaEventi.verificaLocationHref("/php/esplora_eventiPerCategoria.php?categoria=altro"):
            tipoQuery.push(CaricaEventi.CATEGORIA_ALTRO);
            tipoQuery.push('altro');
            break;
        case CaricaEventi.verificaLocationHref("/php/profilo_eventiInteresse.php"):
            tipoQuery.push(CaricaEventi.EVENTI_INTERESSE_UTENTE);
            break;
        case CaricaEventi.verificaLocationHref("/php/profilo_partecipazioni.php"):
            tipoQuery.push(CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE);
            break;
        case CaricaEventi.verificaLocationHref("/php/profilo_eventiCreati.php"):
            if(CaricaEventi.isAdmin){
                tipoQuery.push(CaricaEventi.EVENTI_CREATI_UTENTE_ADMIN);
            }else{
                tipoQuery.push(CaricaEventi.EVENTI_CREATI_UTENTE);
            }
            break;
        default:
        console.log('match non trovato');
            break;                                                
    }
    return tipoQuery;
}

//riceve risposta da server con dati utente e aggiorna
//la pagina web con i dati ricevuti
CaricaEventi.rispostaAjaxProfiloUtente=function(risposta){
    var datiUtente;
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        document.getElementById("err_msg").innerHTML="Impossibile aggiornare il profilo , riprovare!"
        return;
    }
    if((risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE)&&(risposta.data !=null)){
        datiUtente=JSON.parse(risposta.data);
        //chiamo la funzione che aggiorna la pagina web del profilo utente
        gestioneDashboard.riempiFormProfilo(datiUtente);
        console.log(datiUtente);
    }else if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
        document.getElementById("err_msg").innerHTML="Dati profilo aggiornati!"
    }
    
}

CaricaEventi.rispostaAjax=function(risposta){
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        //crea lista eventi vuota nella pagina principale
        var arrayDati=new Array();
        gestioneDashboard.refreshData(arrayDati);
        //return;
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
    CaricaEventi.altriEventiDaCaricare=((risposta.data!==null)&&(risposta.data.length >=CaricaEventi.limiteNumeroEventi));
    //console.log("altrieventidacaricare="+CaricaEventi.altriEventiDaCaricare);
    gestioneDashboard.refreshIndiciPagina(CaricaEventi.CURRENT_PAGE_INDEX,CaricaEventi.altriEventiDaCaricare);    
}
CaricaEventi.rispostaAjaxProfiloEventiCreati=function(risposta){
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        //crea lista eventi vuota nella pagina principale
        var arrayDati=new Array();
        gestioneDashboard.refreshData(arrayDati);
    }
    if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
        var arrayDati=new Array();
        for(var i=0;i<risposta.data.length;i++){
            if(risposta.data[i]!==false)
                arrayDati[i]=JSON.parse(risposta.data[i]);
        }
        console.log(arrayDati);
        gestioneDashboard.refreshDataEventiCreati(arrayDati/*JSON.parse(risposta.data)*/,false);
    }
    var altriEventiDaCaricare=((risposta.data!==null)&&(risposta.data.length >=CaricaEventi.limiteNumeroEventi));
    gestioneDashboard.refreshIndiciPagina(CaricaEventi.CURRENT_PAGE_INDEX,altriEventiDaCaricare); 
}    
CaricaEventi.rispostaAjaxProfiloEventiCreatiAdmin=function(risposta){
    if(risposta.statoRisposta==CaricaEventi.NO_DATA){
        //crea lista eventi vuota nella pagina principale
        var arrayDati=new Array();
        gestioneDashboard.refreshData(arrayDati);
    }
    if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
        var arrayDati=new Array();
        for(var i=0;i<risposta.data.length;i++){
            if(risposta.data[i]!==false)
                arrayDati[i]=JSON.parse(risposta.data[i]);
        }
        console.log(arrayDati);
        gestioneDashboard.refreshDataEventiCreati(arrayDati/*JSON.parse(risposta.data)*/,true);
    }
    var altriEventiDaCaricare=((risposta.data!==null)&&(risposta.data.length >=CaricaEventi.limiteNumeroEventi));
    gestioneDashboard.refreshIndiciPagina(CaricaEventi.CURRENT_PAGE_INDEX,altriEventiDaCaricare); 
}    