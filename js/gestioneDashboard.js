function gestioneDashboard(){}
//crea dinamicamente i tag html usati per generare un evento 
gestioneDashboard.caricaInfoEvento=function(evento){
    //div principale
    var divEvent=document.createElement('div');
    divEvent.setAttribute('class','container');
    //div contenente img e titolo evento
    var divInternoImg=document.createElement('div');
    divInternoImg.setAttribute('class','container-img');
    divInternoImg.setAttribute('onClick','displayEventOnClick(this)');
    divInternoImg.setAttribute('onBlur','hideEventOnBlur(this)');
    var img=document.createElement('img');
    img.setAttribute('class','img');
    img.setAttribute('src',"/images/eventi/" + evento.poster);

    var titoloElem=document.createElement('div');
    titoloElem.setAttribute('class','overlay');
    titoloElem.textContent=evento.titolo;
    //aggiungo img e titolo come figli
    divInternoImg.appendChild(img);
    divInternoImg.appendChild(titoloElem);
    //div interno per raggruppare le informazioni sull'evento
    var divContenuto=document.createElement('div');
    divContenuto.setAttribute('class','event-content');
    //label data evento
    var spanData=document.createElement('span');
    spanData.setAttribute('class','groupA');
    spanData.textContent=evento.data;
    //label luogo evento
    var spanLuogo=document.createElement('span');
    spanLuogo.setAttribute('class','groupB');
    spanLuogo.textContent=evento.luogo;
    //label numero partecipanti
    var maxPartecipantiSpan=document.createElement('span');
    maxPartecipantiSpan.setAttribute('class','groupA');
    if(evento.maxPartecipanti==null){
        maxPartecipantiSpan.textContent='posti non limitati';
    }else{
        maxPartecipantiSpan.textContent="posti liberi:"+evento.maxPartecipanti;
    }
    //label prezzo 
    var prezzoSpan=document.createElement('span');
    prezzoSpan.setAttribute('class','groupB');
    if(evento.prezzo==0){
        prezzoSpan.textContent='gratis';
    }else{
        prezzoSpan.textContent="prezzo(€):"+evento.prezzo;
    }
    //button per accedere alla pagina con le informazioni su tale evento
    var button=document.createElement('a');
    button.textContent="Maggiori Informazioni";
    var infoEvento="/php/pagina_evento.php?idEvento="+evento.idEvento
                    +"&titolo="+evento.titolo
                    +"&descrizione="+evento.descrizione
                    +"&data="+evento.data
                    +"&luogo="+evento.luogo
                    +"&prezzo="+evento.prezzo
                    +"&maxPartecipanti="+evento.maxPartecipanti
                    +"&poster="+evento.poster
                    +"&creatore="+evento.creatore;
    button.setAttribute('href',infoEvento);
    //aggiungo i label precedent come figli di divContenuto
    divContenuto.appendChild(spanData);
    divContenuto.appendChild(spanLuogo);
    divContenuto.appendChild(maxPartecipantiSpan);
    divContenuto.appendChild(prezzoSpan);
    divContenuto.appendChild(button);
    //aggiungo i due div al div principale
    divEvent.appendChild(divInternoImg);
    divEvent.appendChild(divContenuto);
    return divEvent;
}
gestioneDashboard.riempiFormProfilo=function(utente){
    var formInfoUtente=document.getElementById('divContenuto');
    document.getElementById('idUtente').value=utente.idUtente;
    document.getElementById('email').value=utente.email;
    document.getElementById('nome').value=utente.nome;
    document.getElementById('cognome').value=utente.cognome;
    document.getElementById('password').value=utente.password;
    document.getElementById('referral').value=utente.referral;
}

gestioneDashboard.aggiornaProfiloLatoServer=function(){
    var formInfoUtente=document.getElementById('divContenuto');
    var utente={};
    //prelevo le modifiche fatte al profilo dall'utente
    utente['idUtente']=document.getElementById('idUtente').value;
    utente['email']=document.getElementById('email').value;
    utente['nome']=document.getElementById('nome').value;
    utente['cognome']=document.getElementById('cognome').value;
    utente['password']=document.getElementById('password').value;
    utente['referral']=document.getElementById('referral').value;
    //carico informazioni nel database tramite richiesta Ajax
    CaricaEventi.loadDataProfilo(utente);
}
//crea lista di eventi 
gestioneDashboard.creaLista=function(){
    var listaEventi=document.createElement('ul');
    listaEventi.setAttribute('class','lista');
    return listaEventi;
}
gestioneDashboard.creaElementoLista=function(evento){
    var elemLista=document.createElement('li');
    var div=gestioneDashboard.caricaInfoEvento(evento);
    elemLista.appendChild(div);
    return elemLista;
}
//crea il layout evento con pulsanti aggiuntivi
gestioneDashboard.creaElementoListaConDeleteButton=function(evento){
    var elemLista=document.createElement('li');
    var div=gestioneDashboard.caricaInfoEvento(evento);
    //aggiungo il delete button alla struttura del mio evento
    var deleteButton=document.createElement('input');
    deleteButton.setAttribute('type','image');
    deleteButton.setAttribute('class','delete-button');
    deleteButton.setAttribute('src','/images/delete.png');
    deleteButton.setAttribute('title','cancella');
    deleteButton.addEventListener('click',function(){
                                        var tipo_CANCELLAZIONE_EVENTO=14;
                                        var url=CaricaEventi.urlOperazioniAggiornamento
                                                +'?queryType='+tipo_CANCELLAZIONE_EVENTO
                                                +"&idEvento="+evento.idEvento;
                                        AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                                                    url,
                                                                    CaricaEventi.ASYNC_TYPE,
                                                                    null,null);        
                                        elemLista.removeChild(div);
                                    
                                });
    div.appendChild(deleteButton);                              
    elemLista.appendChild(div);
    return elemLista;
}

//crea il layout evento con pulsanti aggiuntivi
gestioneDashboard.creaElementoListaConSegnalaDeleteButton=function(evento){
    var elemLista=document.createElement('li');
    var div=gestioneDashboard.caricaInfoEvento(evento);
    //aggiungo il delete button alla struttura del mio evento
    var deleteButton=document.createElement('input');
    deleteButton.setAttribute('type','image');
    deleteButton.setAttribute('class','delete-button');
    deleteButton.setAttribute('src','/images/delete.png');
    deleteButton.setAttribute('title','cancella');
    deleteButton.addEventListener('click',function(){
                                        var tipo_CANCELLAZIONE_EVENTO=14;
                                        var url=CaricaEventi.urlOperazioniAggiornamento
                                                +'?queryType='+tipo_CANCELLAZIONE_EVENTO
                                                +"&idEvento="+evento.idEvento;
                                        AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                                                    url,
                                                                    CaricaEventi.ASYNC_TYPE,
                                                                    null,null);        
                                        elemLista.removeChild(div);
                                    
                                });
    div.appendChild(deleteButton);
    //aggiungo il pulsante per rendere idoneo il mio evento
    //in seguito a una segnalazione da parte di utente per 
    //contenuto non idoneo
    if(evento.segnalato==1){
        var togliSegnalazioneButton=document.createElement('input');
        togliSegnalazioneButton.setAttribute('type','image');
        togliSegnalazioneButton.setAttribute('class','segnala-button');
        togliSegnalazioneButton.setAttribute('src','/images/segnala.png');
        togliSegnalazioneButton.setAttribute('title','togli segnalazione');
        togliSegnalazioneButton.addEventListener('click',function(){
                                            var tipo_TOGLI_SEGNALAZIONE_EVENTO=22;
                                            var url=CaricaEventi.urlOperazioniAggiornamento
                                                    +'?queryType='+tipo_TOGLI_SEGNALAZIONE_EVENTO
                                                    +"&idEvento="+evento.idEvento;
                                            AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                                                        url,
                                                                        CaricaEventi.ASYNC_TYPE,
                                                                        null,null);        
                                            div.removeChild(togliSegnalazioneButton);
                                        });
        div.appendChild(togliSegnalazioneButton);                                
    }
    elemLista.appendChild(div);
    return elemLista;
}
gestioneDashboard.refreshData=function(arrayEventi){
    var lista=gestioneDashboard.creaLista();
    for(var i=0;i<arrayEventi.length;++i){
        if(arrayEventi[i] !=undefined){
            var elem=gestioneDashboard.creaElementoLista(arrayEventi[i]);
            lista.appendChild(elem);
        }
    }
    //devo aggiungerlo alla pagina web principale
    var node=document.getElementById("divContenuto");
    if(node.firstChild){
        node.removeChild(node.firstChild);
    }
    node.appendChild(lista);
}
gestioneDashboard.refreshDataEventiCreati=function(arrayEventi,admin){
    var lista=gestioneDashboard.creaLista();
    for(var i=0;i<arrayEventi.length;++i){
        if(arrayEventi[i] !=undefined){
            if(admin==true){
                var elem=gestioneDashboard.creaElementoListaConSegnalaDeleteButton(arrayEventi[i]);
            }else{
                var elem=gestioneDashboard.creaElementoListaConDeleteButton(arrayEventi[i]);
            }
            lista.appendChild(elem);
        }
    }
    //devo aggiungerlo alla pagina web principale
    var node=document.getElementById("divContenuto");
    if(node.firstChild){
        node.removeChild(node.firstChild);
    }
    node.appendChild(lista);
}
gestioneDashboard.refreshIndiciPagina=function(currentPage,altriEventidaCaricare){
    var currPage=document.getElementsByClassName("current-page");
    currPage.innerHTML="Pagina "+currentPage;
    
    var previous=document.getElementById("precedente");
    if(currentPage===1){
        previous.disabled=true;
    }else{
        previous.disabled=false;
    }

    var next=document.getElementById("successivo");
    if(altriEventidaCaricare){
        next.disabled=false;
    }else{
        next.disabled=true;
    }
}
//rendo le parti di input del form utente modificabili    
gestioneDashboard.rendiModificabileFormElement=function(dataInput){
    if(dataInput.disabled==true){
        dataInput.disabled=false;
    }
}