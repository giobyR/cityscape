<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_AJAX.'rispostaAjax.php';
    require_once DIR_DATABASE.'cityscapeDB_manager.php';


    //recupera gli eventi futuri in ordine ascendente
    function recuperaEventiPiuRecenti($limite_risultati,$offset){
        global $cityscapeDB;
        $limite_risultati=$cityscapeDB->sqlInjectionFilter($limite_risultati);
        //devo modificare questa query perche sto prendendo eventi passati a oggi e non futuri
        $query="SELECT * FROM evento WHERE dataEvento<=CURRENT_DATE ORDER BY dataEvento ASC LIMIT ".$offset.",".$limite_risultati.";";
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
                ."GROUP BY SU.evento ) AS D ON E.idEvento=D.evento"
                ."GROUP BY E.idEvento ORDER BY D.Interessi DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi di interesse a un certo utente
    function recuperaEventiInteresseUtente($limite_risultati,$utente,$offset){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN statisticheutenti SU ON E.idEvento=SU.evento"
                ." WHERE SU.utente=".$utente." AND SU.interesse=1"
                ."GROUP BY E.idEvento ORDER BY E.dataCreazione DESC LIMIT ".$offset.",".$limite_risultati.";";
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
                ."GROUP BY E.idEvento ORDER BY E.dataCreazione DESC LIMIT ".$offset.",".$limite_risultati.";";
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
        $query="INSERT INTO statisticheutenti VALUES('".$idEvento."','".$utente."',1,0);";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //aggiunge partecipazione utente nel database
    function aggiungiPartecipazioneUtente($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        $query="INSERT INTO statisticheutenti VALUES('".$idEvento."','".$utente."',1,1);";
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
        $idEvento=$cityscape->sqlInjectionFilter($idEvento);
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
    //cerca nel campo titolo e descrizione di un evento una certa parola chiave
    function cercaParolaChiave($parola_chiave,$limite_risultati,$offset){
        global $cityscapeDB;
        $parola_chiave=$cityscapeDB->sqlInjectionFilter($parola_chiave);
        $query="SELECT * FROM evento WHERE (descrizione LIKE '%".$parola_chiave."%' ) "
                ."OR (titolo LIKE '%".$parola_chiave."%' )"
                ." GROUP BY idEvento ORDER BY dataEvento DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";        
        $cityscapeDB->closeConnection();
        return $result; 
    }
    //cerca evento in base a un certo luogo inserito
    function cercaLuogo($luogo,$limite_risultati,$offset){
        global $cityscapeDB;
        $luogo=$cityscapeDB->sqlInjectionFilter($luogo);
        $query="SELECT * FROM evento WHERE luogo LIKE '%".$luogo."%' "
                ."GROUP BY idEvento ORDER BY dataEvento DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";        
        $cityscapeDB->closeConnection();
        return $result; 
    }
    //cerca evento nel database in base a una certa data inserita come parola chiave
    function cercaData($data,$limite_risultati,$offset){
        global $cityscapeDB;
        $data=$cityscapeDB->sqlInjectionFilter($data);
        $query="SELECT * FROM evento WHERE dataEvento LIKE '%".$data."%' "
            ."GROUP BY idEvento ORDER BY dataEvento DESC LIMIT ".$offset.",".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //echo "<script>console.log('".$query."')</script>";        
        $cityscapeDB->closeConnection();
        return $result; 
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