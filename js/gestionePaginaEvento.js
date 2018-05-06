        
        //invia la partecipazione 
        //controlla validità referral e indica lo sconto corrispondente
        function verificaReferral(referral,idEvento){
            if(document.getElementById('referral').value ==referral){
                var ricevi_sconto_referral=17;
                var url=CaricaEventi.urlOperazioniAggiornamento
                        +"?queryType="
                        +ricevi_sconto_referral
                        +"&idEvento="+idEvento
                        +"&referral="+referral;
                var responseFunction=riceviSconto;
                AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                            url,
                                            CaricaEventi.ASYNC_TYPE,
                                            null,
                                            responseFunction);
            }else{
                document.getElementById('errMsg').innerHTML="codice referral non valido!";
                return;
            }
        }
        function abilitaReferral(){
            if(document.getElementById('sceltaSI').checked ==true){
                document.getElementById('referral').disabled=false;
            }else{
                document.getElementById('referral').disabled=true;
            }
        }
        function riceviSconto(risposta){
            if(risposta.statoRisposta==CaricaEventi.NO_DATA){
                document.getElementById('errMsg').innerHTML="nessuno sconto trovato!";
                console.log(document.getElementById('errMsg').value);
            }
            if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
                var sconto=JSON.parse(risposta.data);
                document.getElementById('errMsg').innerHTML="trovato uno sconto sul prezzo di prenotazione pari a "+sconto+"!";
                console.log(document.getElementById('errMsg').value);
            }
        }
        function inviaPartecipazione(idEvento,utente){
            if(typeof utente =="undefined"){
                document.getElementById('errMsg').innerHTML="Impossibile inviare la partecipazione perche devi essere registrato!";
                return;
            }
            var url=CaricaEventi.urlOperazioniAggiornamento
                    +"?queryType="
                    +CaricaEventi.AGGIUNGI_PARTECIPAZIONE
                    +"&idEvento="+idEvento
                    +"&utente="+utente;
            var responseFunction=riceviConferma;
            AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
        }                        
        function riceviConferma(risposta){
            if(risposta.statoRisposta==CaricaEventi.NO_DATA){
                document.getElementById('errMsg').innerHTML="Impossibile salvare la partecipazione, riprovare!";
            }
            if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
                document.getElementById('errMsg').innerHTML="Evento prenotato!";
            }
        }            