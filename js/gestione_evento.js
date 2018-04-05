function gestioneEvento(){}
gestioneEvento.idEvento=null;
gestioneEvento.titolo=null;
gestioneEvento.descrizione=null;
gestioneEvento.dataEvento=null;
gestioneEvento.luogoEvento=null;

gestioneEvento.caricaInfoEvento=function(evento){
    //div principale
    var divEvent=document.createElement('div');
    divEvent.setAttribute('class','container');
    //div contenente img e titolo evento
    var divInternoImg=document.createElement('div');
    divInternoImg.setAttribute('class','container-img');
    divInternoImg.setAttribute('onClick','displayEventOnClick(this)');

    var img=document.createElement('img');
    img.setAttribute('class','img');
    img.setAttribute('src','/images/eventi/'+evento.poster);

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
    if(evento.maxPartecipanti=0){
        maxPartecipantiSpan.textContent='posti non limitati';
    }else{
        maxPartecipantiSpan.textContent=evento.maxPartecipanti;
    }
    //label prezzo 
    var prezzoSpan=createElement('span');
    prezzoSpan.setAttribute('class','groupB');
    if(evento.prezzo=0){
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
    //aggiungo i due div al div principale
    divEvent.appendChild(divInternoImg);
    divEvent.appendChild(divContenuto);
    return divEvent;
}
gestioneEvento.creaLista=function(){
    var listaEventi=document.createElement('ul');
    return listaEventi;
}
gestioneEvento.creaElementoLista=function(evento){
    var elemLista=document.createElement('li');
    var div=gestioneEvento.caricaInfoEvento(evento);
    elemLista.appendChild(div);
    return elemLista;
}
gestioneEvento.refreshData=function(arrayEventi){
    var lista=gestioneEvento.creaLista;
    for(var i=0;i<arrayEventi.length;i++){
        var elem=gestioneEvento.creaElementoLista(arrayEventi[i]);
        lista.appendChild(elem);
    }
    //devo aggiungerlo alla pagina web principale
}