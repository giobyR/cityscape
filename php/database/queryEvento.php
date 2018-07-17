<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_AJAX.'rispostaAjax.php';
    require_once DIR_DATABASE.'cityscapeDB_manager.php';


    //recupera gli eventi futuri in ordine ascendente
    function recuperaEventiPiuRecenti($limite_risultati,$offset){
        global $cityscapeDB;
        $limite_risultati=$cityscapeDB->sqlInjectionFilter($limite_risultati);
        //devo modificare questa query perche sto prendendo eventi passati a oggi e non futuri
        $query="SELECT * FROM evento WHERE dataEvento>=CURRENT_DATE ORDER BY dataEvento ASC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //recupera gli eventi in base alla categoria scelta
    function recuperaEventiPerCategoria($categoria,$limite_risultati,$offset){
        global $cityscapeDB;
        $categoria=$cityscapeDB->sqlInjectionFilter($categoria);
        $limite_risultati=$cityscapeDB->sqlInjectionFilter($limite_risultati);
        $query="SELECT * FROM evento WHERE categoria='".$categoria."' "
                ."AND dataEvento>=CURRENT_DATE ORDER BY dataEvento ASC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi raggruppati per interesse utenti in ordine decrescente 
    function recuperaEventiPerInteresse($limite_risultati,$offset){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN "
                ."(SELECT SU.evento,COUNT(*) AS Interessi FROM statisticheutenti SU "
                ."GROUP BY SU.evento ) AS D ON E.idEvento=D.evento "
                ."GROUP BY E.idEvento ORDER BY D.Interessi DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi di interesse a un certo utente
    function recuperaEventiInteresseUtente($limite_risultati,$utente,$offset){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN statisticheutenti SU ON E.idEvento=SU.evento"
                ." WHERE SU.utente=".$utente." AND SU.interesse=1 "
                ."GROUP BY E.idEvento ORDER BY E.dataCreazione ASC LIMIT ".$offset.",".$limite_risultati.";";
        //echo "<script>console.log('".$query."'</script>";        
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi a cui l'utente partecipa
    function recuperaEventiPartecipazioneUtente($limite_risultati,$utente,$offset){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN statisticheutenti SU ON E.idEvento=SU.evento"
                ." WHERE SU.utente=".$utente." AND SU.partecipazione=1 "
                ."GROUP BY E.idEvento ORDER BY E.dataCreazione ASC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }    
    //recupera eventi creati da un certo utente
    function recuperaEventiCreati($limite_risultati,$idUtente,$offset){
        global $cityscapeDB;
        $query="SELECT * FROM evento WHERE creatore=".$idUtente." ORDER BY dataCreazione DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }
    //recupera tutti gli eventi presenti nel database per l'admin di sistema
    function recuperaEventiCreatiAdmin($limite_risultati,$offset){
        global $cityscapeDB;
        $query="SELECT * FROM evento ORDER BY dataCreazione DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }
    //recupera informazioni account utente
    function recuperaAccountUtente($idUtente){
        global $cityscapeDB;
        $query="SELECT * FROM utente WHERE idUtente='".$idUtente."';";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }
    //aggiorna le informazioni sull'utente presenti nel databasae
    function aggiornaAccountUtente($infoUtente){
        global $cityscapeDB;
        $query="UPDATE utente SET nome='".$infoUtente->nome."', "
                ."cognome='".$infoUtente->cognome."', "
                ."email='".$infoUtente->email."', "
                ."password='".$infoUtente->password."', "
                ."codiceReferral='".$infoUtente->referral."' "
                ."WHERE idUtente='".$infoUtente->idUtente."' ;";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";
        $cityscapeDB->closeConnection();
        return $result;         
    }
    //aggiunge nel database l'interesse utente nei confronti di un nuovo evento
    function aggiungiInteresseUtente($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        $query="INSERT INTO statisticheutenti(evento,utente,interesse) VALUES('".$idEvento."','".$utente."',1);";
            //."ON DUPLICATE KEY UPDATE interesse=1;";  da abilitare se voglio inviare sempre richiesta di salvataggio
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //aggiunge partecipazione utente nel database
    function aggiungiPartecipazioneUtente($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        $query="INSERT INTO statisticheutenti(evento,utente,interesse,partecipazione) VALUES('".$idEvento."','".$utente."',1,1)"
            ."ON DUPLICATE KEY UPDATE interesse=1,partecipazione=1;";
        //do per scontato che se l útente partecipa a un evento è anche interessato a tale evento 
        aggiungiInteresseUtente($idEvento,$utente);
        //echo "<script>console.log('".$query."')</script>";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //in base al codice referral restituisce lo sconto applicato corrispondente
    function getScontoReferral($referral,$idEvento){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $referral=$cityscapeDB->sqlInjectionFilter($referral);
        $query="SELECT S.sconto FROM sconto S WHERE S.referral='".$referral."' AND S.evento=".$idEvento.";";
        //echo "<script>console.log('".$query."')</script>";        
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //prende il codice referral corrispondente a un certo utente
    function getReferral($idUtente){
        global $cityscapeDB;
        $idUtente=$cityscapeDB->sqlInjectionFilter($idUtente);
        $query="SELECT U.codiceReferral FROM utente U WHERE U.idUtente=".$idUtente.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";        
        $cityscapeDB->closeConnection();
        return $result;
    }
    //cancella evento dal database
    function cancellaEvento($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        //cancello l'evento dal database
        $query="DELETE FROM evento WHERE idEvento=".$idEvento." AND creatore=".$utente.";";
        //echo "<script>console.log('".$query."'</script>";        
        $result=$cityscapeDB->lanciaQuery($query);
        //cancello tutte le statistiche collegate a questo evento
        $query="DELETE FROM statisticheutenti WHERE evento=".$idEvento.";";
        $result2=$cityscapeDB->lanciaQuery($query);
        $result=$result && $result2;
        $cityscapeDB->closeConnection();
        return $result;
    }
    //togli segnalazione evento dal database
    function togliSegnalazione($idEvento){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $query="UPDATE evento SET segnalato=0 WHERE idEvento=".$idEvento.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";
        $cityscapeDB->closeConnection();
        return $result;
    }
    //segnala l'evento indicato come contenuto inappropiato
    function segnalaEvento($idEvento){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $query="UPDATE evento SET segnalato=1 WHERE idEvento=".$idEvento.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";
        $cityscapeDB->closeConnection();
        return $result;
    }
    //restituisce il numero di persone interessate per un certo evento
    function restituisciInteressati($idEvento){
        global $cityscapeDB;
        $idEvento=$cityscape->sqlInjectionFilter($idEvento);
        $query="SELECT evento,count(interesse) as interessati FROM statisticheutenti "
                ."WHERE evento=".$idEvento.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //serve per interrogare il database durante una ricerca fatta
    //dall'utente in base alla tematica della pagina che sta navigando
    //ed effettuare la ricerca di una parola chiave all'interno 
    //degli eventi restituiti.

    //tipoEventoCercato seleziona una delle possibili query usate
    //per recuperare eventi dal database
    //una volta selezionato eventi dal database
    //converto il result set in un array per fare la ricerca della parola chiave.
    function preparaQueryRicerca($limite_risultati,$offset,$tipoEventoCercato){
        //interrogo il database in base al tipo di evento richiesto
        $result=selezionaQueryEvento($limite_risultati,$offset,$tipoEventoCercato);
        $risposta=new RispostaAjax();
        //verifico che il result set ricevuto non sia vuoto 
        if((($result===null)||(!$result))||($result->num_rows <=0)){
            $data=array();
            return;
        }
        //arrivato a questo punto devo convertire il result set
        //in un array dove cercare la parola chiave 
        $data=array();
        $indice=0;
        while($row = $result->fetch_assoc()){
            //usando la classe evento creo un nuovo oggetto evento
            $evento= new Evento();
            $evento->idEvento=$row['idEvento'];
            $evento->titolo=$row['titolo'];
            $evento->descrizione=$row['descrizione'];
            $evento->data=$row['dataEvento'];
            $evento->luogo=$row['luogo'];
            $evento->prezzo=$row['prezzo'];
            $evento->maxPartecipanti=$row['maxPartecipanti'];
            $evento->creatore=$row['creatore'];
            $evento->poster=$row['poster'];
            $evento->segnalato=$row['segnalato'];
            //salvo ogni evento in un array
            $data[$indice]=$evento; 
            $indice++;
        }
        //restituisco l'array per essere usato dalle funzioni
        //di ricerca per individuare gli eventi richiesti
        return $data;
    }
    //cerca nel campo titolo e descrizione di un evento una certa parola chiave
    function cercaParolaChiave($parola_chiave,$limite_risultati,$offset,$tipoEventoCercato){
        $arrayEventi=array();
        $data=preparaQueryRicerca($limite_risultati,$offset,$tipoEventoCercato);
        if($parola_chiave==""){
            return $data;
        }
        for($i=0;$i<count($data);$i++){
            if((stripos($data[$i]->titolo,$parola_chiave)!==false)||(stripos($data[$i]->descrizione,$parola_chiave)!==false)){
                array_push($arrayEventi,$data[$i]);
            }
        }
        return $arrayEventi;
    }
    //cerca evento in base a un certo luogo inserito
    function cercaLuogo($luogo,$limite_risultati,$offset,$tipoEventoCercato){
        $arrayEventi=array();
        $data=preparaQueryRicerca($limite_risultati,$offset,$tipoEventoCercato);
        if($luogo==""){
            return $data;
        }
        for($i=0;$i<count($data);$i++){
            if(stripos($data[$i]->luogo,$luogo)!==false){
                array_push($arrayEventi,$data[$i]);
            }
        }
        return $arrayEventi;
    }
    //cerca evento nel database in base a una certa data inserita come parola chiave
    function cercaData($dataDaCercare,$limite_risultati,$offset,$tipoEventoCercato){
        $arrayEventi=array();
        $data=preparaQueryRicerca($limite_risultati,$offset,$tipoEventoCercato);
        if($dataDaCercare==""){
            return $data;
        }
        for($i=0;$i<count($data);$i++){
            if(stripos($data[$i]->data,$dataDaCercare)!==false){
                array_push($arrayEventi,$data[$i]);
            }
        }
        return $arrayEventi;
    }
    //salva nel database l'id corrispondente a un certo luogo usabile dalle API Google
    function salvaLuogo($placeID,$indirizzo){
        global $cityscapeDB;
        $data=$cityscapeDB->sqlInjectionFilter($placeID);
        $data=$cityscapeDB->sqlInjectionFilter($placeID);
        $query="INSERT INTO luogoMaps VALUES('".$placeID."','".$indirizzo."');";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";        
        $cityscapeDB->closeConnection();
        return $result;
    }
?>