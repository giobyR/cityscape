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
        maxPartecipantiSpan.textContent=evento.maxPartecipanti;
    }
    //label prezzo 
    var prezzoSpan=document.createElement('span');
    prezzoSpan.setAttribute('class','groupB');
    if(evento.prezzo==0){
        prezzoSpan.textContent='gratis';
    }else{
        prezzoSpan.textContent=evento.prezzo;
    }
    //button per accedere alla pagina con le informazioni su tale evento
    var button=document.createElement('button');
    button.textContent="Maggiori Informazioni";
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
    var utente=new Array();
    //prelevo le modifiche fatte al profilo dall'utente
    utente['idUtente']=document.getElementById('idUtente').value;
    utente['email']=document.getElementById('email').value;
    utente['nome']=document.getElementById('nome').value;
    utente['cognome']=document.getElementById('cognome').value;
    utente['password']=document.getElementById('password').value;
    utente['referral']=document.getElementById('referral').value;
    //carico informazioni nel database tramite richeista Ajax
    CaricaEventi.loadDataProfilo(CaricaEventi.AGGIORNA_UTENTE,utente);
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
gestioneDashboard.refreshData=function(arrayEventi){
    var lista=gestioneDashboard.creaLista();
    for(var i=0;i<arrayEventi.length;++i){
        if(arrayEventi[i] !=undefined){
            var elem=gestioneDashboard.creaElementoLista(arrayEventi[i]);
            lista.appendChild(elem);
        }
    }
    //devo aggiungerlo alla pagina web principale
    document.getElementById("divContenuto").appendChild(lista);
}
