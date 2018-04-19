        
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
            }
        }
        function abilitaReferral(){
            if(document.getElementById('sceltaSI').checked !=false){
                document.getElementById('referral').setAttribute('disabled','false');
            }else{
                document.getElementById('referral').setAttribute('disabled','true');
            }
        }
        function riceviSconto(risposta){
            if(risposta.statoRisposta==CaricaEventi.NO_DATA){
                document.getElementById('errMsg').innerHTML="nessuno sconto trovato!";
            }
            if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
                var sconto=JSON.parse(risposta.data);
                document.getElementById('errMsg').innerHTML="trovato uno sconto sul prezzo di prenotazione pari a"+sconto+"!";
            }
        }
        function inviaPartecipazione(idEvento,utente){
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